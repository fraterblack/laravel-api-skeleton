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
        $this->userRoutes();
        $this->loginRoutes();
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

    protected function userRoutes()
    {
        $this->router->get('test', function (\Illuminate\Http\Request $request) {
            return $request->user();

            /*return [
                'message' => 'test page'
            ];*/
        })->middleware('auth:api');
    }

    protected function loginRoutes()
    {
        $this->router->group(['namespace' => 'Authentication'], function () {
            $this->router->post('login', 'LoginController@login');
        });
    }
}