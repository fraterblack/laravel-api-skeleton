<?php

namespace Saf\Applications\Api\Routes;

use Saf\Support\Http\Routing\RouteFile;

/**
 * Web Routes.
 *
 * This file is where you may define all of the routes that are handled
 * by your application. Just tell Laravel the URIs it should respond
 * to using a Closure or controller method. Build something great!
 */
class Api extends RouteFile
{
    /**
     * Declare Web Routes.
     */
    public function routes()
    {
        $this->router->pattern('id', '[0-9]+');

        $this->registerV1Routes();
    }

    protected function registerDefaultRoutes()
    {
        $this->registerAuthenticationRoutes();
    }

    /**
     * Registra rotas da versão 1 da API
     */
    protected function registerV1Routes()
    {
        $this->router->group(['prefix' => 'v1'], function () {
            $this->registerDefaultRoutes();
        });
    }

    /**
     * Registra as rotas do Namespace Authentication
     */
    protected function registerAuthenticationRoutes()
    {
        $this->router->group(['namespace' => 'Authentication'], function () {
            $this->userRoutes();
            $this->loginRoutes();
            $this->signUpRoutes();
            $this->passwordRoutes();
        });
    }

    protected function userRoutes()
    {
        $this->router->get('user', function (\Illuminate\Http\Request $request) {
            return $request->user();
        })->middleware('auth:api');
    }

    protected function loginRoutes()
    {
        $this->router->post('login', 'LoginController@login');
    }

    protected function signUpRoutes()
    {
        $this->router->post('register', 'RegisterController@register');
    }

    protected function passwordRoutes()
    {
        $this->router->post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
        $this->router->post('password/reset', 'ResetPasswordController@reset');
    }
}