<?php

namespace Saf\Support\Services\Mail\Providers;

use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(
            \Saf\Support\Services\Mail\Contracts\MailService::class,
            \Saf\Support\Services\Mail\MailerService::class
        );
    }
}