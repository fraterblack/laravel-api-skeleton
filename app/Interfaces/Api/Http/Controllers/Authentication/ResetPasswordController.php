<?php

namespace Saf\Interfaces\Api\Http\Controllers\Authentication;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;
use Saf\Interfaces\Shared\Http\Requests\Users\ResetPasswordRequest;
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

        parent::__construct();
    }

    /**
     * Reset the given user's password.
     *
     * @param  ResetPasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(ResetPasswordRequest $request)
    {
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($response)
            : $this->sendResetFailedResponse($request, $response);
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