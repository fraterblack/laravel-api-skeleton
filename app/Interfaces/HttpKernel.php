<?php

namespace Saf\Interfaces;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Saf\Interfaces\Shared\Http\Middleware\AlwaysExpectsJson;
use Saf\Interfaces\Shared\Http\Middleware\EncryptCookies;
use Saf\Interfaces\Shared\Http\Middleware\RedirectIfAuthenticated;
use Saf\Interfaces\Shared\Http\Middleware\RedirectIfWrongUrlOrProtocol;
use Saf\Interfaces\Shared\Http\Middleware\VerifyCsrfToken;

class HttpKernel extends Kernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            SubstituteBindings::class,
            EncryptCookies::class,
            VerifyCsrfToken::class,
            RedirectIfWrongUrlOrProtocol::class,
        ],

        'api' => [
            'always_expects_json',
            'throttle:10,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'always_expects_json' => AlwaysExpectsJson::class,
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'bindings' => SubstituteBindings::class,
        'can' => Authorize::class,
        'guest' => RedirectIfAuthenticated::class,
        'throttle' => ThrottleRequests::class,
    ];
}
