<?php

namespace Saf\Applications\Api\Providers;

use Saf\Support\Applications\ServiceProvider;

class ApplicationServiceProvider extends ServiceProvider
{
    protected $alias = 'api';

    protected $providers = [
        RouteServiceProvider::class,
    ];
}
