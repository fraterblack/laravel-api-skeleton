<?php

namespace Saf\Applications\Api\Providers;

use Saf\Support\Applications\ServiceProvider;

class ApplicationServiceProvider extends ServiceProvider
{
    protected $alias = 'api';

    protected $hasViews = true;

    protected $hasTranslations = true;

    protected $providers = [
        RouteServiceProvider::class,
    ];
}
