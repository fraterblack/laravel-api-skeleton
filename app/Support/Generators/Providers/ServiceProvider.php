<?php

namespace Saf\Support\Generators\Providers;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function register()
    {
        $this->registerCommands();
    }

    private function registerCommands()
    {
        $this->commands(\Saf\Support\Generators\Commands\RepositoryMakeCommand::class);
        $this->commands(\Saf\Support\Generators\Commands\RepositoryContractMakeCommand::class);

        $this->commands(\Saf\Support\Generators\Commands\ServiceMakeCommand::class);
        $this->commands(\Saf\Support\Generators\Commands\ServiceContractMakeCommand::class);
    }
}
