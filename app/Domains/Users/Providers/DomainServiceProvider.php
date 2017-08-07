<?php

namespace Saf\Domains\Users\Providers;

use Saf\Domains\Users\Contracts;
use Saf\Domains\Users\Database\Migrations;
use Saf\Domains\Users\Database\Seeders;
use Saf\Domains\Users\Database\Factories;
use Saf\Domains\Users\Repositories;
use Saf\Support\Domain\ServiceProvider;

/**
 * Class DomainServiceProvider.
 *
 * Register Users Domain Resources and Services
 */
class DomainServiceProvider extends ServiceProvider
{
    /**
     * @var string Domain "alias"
     */
    protected $alias = 'users';

    /**
     * @var bool Enable translations
     */
    protected $hasTranslations = true;

    /**
     * @var array Providers registered within the domain
     */
    protected $subProviders = [
        EventServiceProvider::class,
    ];

    /**
     * @var array Bind contracts to implementations
     */
    protected $bindings = [
        Contracts\UserRepository::class => Repositories\UserRepository::class,
    ];

    /**
     * @var array Migrations of this domains
     */
    protected $migrations = [
        Migrations\CreateUsersTable::class,
        Migrations\CreatePasswordResetsTable::class,
    ];

    /**
     * @var array Some Seeders
     */
    protected $seeders = [
        Seeders\UsersSeeder::class,
    ];

    /**
     * @var array Model factories
     */
    protected $factories = [
        Factories\UserFactory::class
    ];
}
