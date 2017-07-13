<?php

namespace Saf\Domains\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Saf\Domains\Users\User;

/**
 * Class UsersSeeders.
 */
class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();

        //Usuário Master
        $superUser = User::create([
            'name' => 'Usuário Teste',
            'email' => 'teste@teste.com.br',
            'password' => bcrypt('123456'),
            'active' => 1
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
