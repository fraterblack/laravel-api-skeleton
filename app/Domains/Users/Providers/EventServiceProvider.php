<?php

namespace Saf\Domains\Users\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Saf\Domains\Users\Events;
use Saf\Domains\Users\Listeners;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $listen = [
        Events\NewUserEvent::class => [
            //Listeners\NewUserNotification::class
        ],
        Events\UpdatedUserEvent::class => [
            //Listeners\UpdatedUserNotification::class
        ],
    ];
}
