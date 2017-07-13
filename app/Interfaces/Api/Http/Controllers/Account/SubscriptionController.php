<?php

namespace Saf\Interfaces\Api\Http\Controllers\Account;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Saf\Domains\Users\Contracts\UserRepository;
use Saf\Domains\Users\Events\NewUserEvent;
use Saf\Interfaces\Shared\Http\Requests\Users\StoreUserRequest;
use Saf\Support\Http\Controller;

class SubscriptionController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');

        parent::__construct();
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  StoreUserRequest $request'
     * @param UserRepository $userRepository
     * @return \Illuminate\Http\Response
     */
    public function register(StoreUserRequest $request, UserRepository $userRepository)
    {
        $newPassword = $request->get('password');

        $request->merge([ 'password' => bcrypt($request->get('password')) ]);

        $user = $userRepository->create($request->all());

        event(new NewUserEvent($user, $newPassword));

        $this->guard()->login($user);

        try {
            $token = app('tymon.jwt.auth')->fromUser($user);
        } catch (\Exception $e) {
            return response()->json(['error generating token'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(['token' => $token], Response::HTTP_CREATED);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}