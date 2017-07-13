<?php

namespace Saf\Interfaces\Api\Routes;

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
        $this->registerAccountRoutes();
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
     *
     * Registra as rotas do Namespace Authentication
     *
     */
    protected function registerAuthenticationRoutes()
    {
        $this->router->group(['namespace' => 'Authentication'], function () {
            $this->loginRoutes();
            $this->passwordRoutes();
        });
    }

    protected function loginRoutes()
    {
        $this->router->post('login', 'LoginController@login');
    }

    protected function passwordRoutes()
    {
        $this->router->post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
        $this->router->post('password/reset', 'ResetPasswordController@reset');
    }

    /**
     *
     * Registra as rotas do Namespace Account
     *
     */
    protected function registerAccountRoutes()
    {
        $this->router->group(['namespace' => 'Account'], function () {
            $this->subscriptionRoutes();
            $this->userRoutes();
        });
    }

    protected function subscriptionRoutes()
    {
        $this->router->post('subscription', 'SubscriptionController@register');
    }

    protected function userRoutes()
    {
        $this->router->get('me', 'AccountController@show')->middleware('auth:api');
    }
}