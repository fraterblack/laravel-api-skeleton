<?php

namespace Saf\Applications\Api\Http\Controllers\Authentication;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Saf\Support\Http\Controller;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = $request->only('email', 'password', 'token');

        return array_merge($credentials, [
            'password_confirmation' => $credentials['password']
        ]);
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    protected function sendResetResponse($response)
    {
        $token = null;

        try {
            $user = $this->guard()->user();

            $token = app('tymon.jwt.auth')->fromUser($user);
        } catch (\Exception $e) {
            throw new \Exception("Could not Generate Token");
        }

        return response()->json([
            'status' => trans($response),
            'token'  => $token,
        ], Response::HTTP_OK);
    }
    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json([
            'error' => trans($response)
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}