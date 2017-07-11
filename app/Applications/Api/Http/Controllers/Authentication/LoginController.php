<?php

namespace Saf\Applications\Api\Http\Controllers\Authentication;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Saf\Support\Http\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    use ThrottlesLogins;

    public function login(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = app('tymon.jwt.auth')->attempt($credentials)) {
                // Increments login attempts
                $this->incrementLoginAttempts($request);

                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // Increments login attempts
            $this->incrementLoginAttempts($request);

            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // all good so return the token
        return response()->json(compact('token'));
    }

    /**
     * @return string
     */
    protected function username()
    {
        return 'email';
    }

    /**
     * @inheritdoc
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()
            ->availableIn(
                $this->throttleKey($request)
            );

        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);

        return response()
            ->json(['error' => $message], Response::HTTP_TOO_MANY_REQUESTS);
    }
}