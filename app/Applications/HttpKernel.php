<?php

namespace Saf\Applications;

use Illuminate\Foundation\Http\Kernel;

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
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Saf\Applications\Infrastructure\Http\Middleware\EncryptCookies::class,
            \Saf\Applications\Infrastructure\Http\Middleware\VerifyCsrfToken::class,
            \Saf\Applications\Infrastructure\Http\Middleware\RedirectIfWrongUrlOrProtocol::class,
        ],

        'api' => [
            'throttle:60,1',
            'auth:api',
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
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \Saf\Applications\Infrastructure\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

        // Access control using permissions
        //'needsPermission' => \Artesaos\Defender\Middlewares\NeedsPermissionMiddleware::class,

        // Simpler access control, uses only the groups
        //'needsRole' => \Artesaos\Defender\Middlewares\NeedsRoleMiddleware::class
    ];
}
