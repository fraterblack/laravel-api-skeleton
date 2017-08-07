<?php

namespace Saf\Domains\Users;

use Saf\Support\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class UserTest extends \TestCase
{
    use DatabaseMigrations, InteractsWithDatabase;

    protected function setUp()
    {
        parent::setUp();
    }

    public function testCreateUser()
    {
        $this->runDatabaseMigrations();

        factory(User::class)->create();

        $this->assertDatabaseHas('users', [
            'id' => 1
        ]);
    }
}