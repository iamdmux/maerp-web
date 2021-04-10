<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'DavideM',
            'email' => 'davidemarchiori.dev@gmail.com',
            'password' => '$2y$10$hItalZfJJ5TnmRER/euBX.vM000uMUhGfSj0H9D7fqivmRD/K5B96',
        ]);
        
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Diego de Maio',
            'email' => 'ceo@gymia.io',
            'password' => '$2y$10$.OV88ZUL4ZU3nziGUmKas.FyvmeBgqAwpFR6UXRO6MHJsYSwN/3L.',
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Anna',
            'email' => 'anna@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Davide & Roberto',
            'email' => 'davideroberto@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'name' => 'Cliente direzionale',
            'email' => 'direzionale@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 6,
            'name' => 'Bessem',
            'email' => 'bessem@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 7,
            'name' => 'Gemma',
            'email' => 'gemma@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 8,
            'name' => 'Alona',
            'email' => 'alona@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 9,
            'name' => 'Elena',
            'email' => 'elena@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);
    }
}
