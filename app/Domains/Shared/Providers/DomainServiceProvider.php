<?php

namespace Saf\Domains\Shared\Providers;

use Saf\Domains\Shared\Contracts;
use Saf\Domains\Shared\Database\Migrations;
use Saf\Domains\Shared\Database\Seeders;
use Saf\Domains\Shared\Repositories;
use Saf\Support\Domain\ServiceProvider;

/**
 * Class DomainServiceProvider.
 *
 * Register Shared Domain Resources and Services
 */
class DomainServiceProvider extends ServiceProvider
{
    /**
     * @var string Domain "alias"
     */
    protected $alias = 'shared';

    /**
     * @var bool Enable translations
     */
    protected $hasTranslations = false;

    /**
     * @var array Providers registered within the domain
     */
    protected $subProviders = [
        //
    ];

    /**
     * @var array Bind contracts to implementations
     */
    protected $bindings = [
        Contracts\AttacherRepository::class => Repositories\AttacherRepository::class,
    ];

    /**
     * @var array Migrations of this domains
     */
    protected $migrations = [
        Migrations\CreateAttacherImagesTable::class,
        Migrations\CreateLogsTable::class,
        Migrations\CreateJobsTable::class,
        Migrations\CreateFailedJobsTable::class,
    ];

    /**
     * @var array Some Seeders
     */
    protected $seeders = [
        Seeders\AttacherImagesSeeder::class,
    ];

    /**
     * @var array Model factories
     */
    protected $factories = [
        //
    ];
}
