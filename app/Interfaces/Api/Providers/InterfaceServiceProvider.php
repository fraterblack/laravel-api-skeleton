<?php

namespace Saf\Interfaces\Api\Providers;

use Saf\Support\Interfaces\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{
    protected $alias = 'api';

    protected $providers = [
        RouteServiceProvider::class,
    ];
}
