<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
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
        $slugLength = User::SLUGLENGTH;

        DB::table('users')->insert([
            'id' => 1,
            'name' => 'DavideM',
            'slug' => Str::random($slugLength),
            'email' => 'davidemarchiori.dev@gmail.com',
            'password' => '$2y$10$hItalZfJJ5TnmRER/euBX.vM000uMUhGfSj0H9D7fqivmRD/K5B96',
        ]);
        
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Diego de Maio',
            'slug' => Str::random($slugLength),
            'email' => 'ceo@gymia.io',
            'password' => '$2y$10$.OV88ZUL4ZU3nziGUmKas.FyvmeBgqAwpFR6UXRO6MHJsYSwN/3L.',
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Direzione',
            'slug' => Str::random($slugLength),
            'email' => 'direzione@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Anna',
            'slug' => Str::random($slugLength),
            'email' => 'anna@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'name' => 'Davide & Roberto',
            'slug' => Str::random($slugLength),
            'email' => 'davideroberto@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 6,
            'name' => 'Cliente direzionale',
            'slug' => Str::random($slugLength),
            'email' => 'direzionale@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 7,
            'name' => 'Bessem',
            'slug' => Str::random($slugLength),
            'email' => 'bessem@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 8,
            'name' => 'Gemma',
            'slug' => Str::random($slugLength),
            'email' => 'gemma@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 9,
            'name' => 'Alona',
            'slug' => Str::random($slugLength),
            'email' => 'alona@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 10,
            'name' => 'Elena',
            'slug' => Str::random($slugLength),
            'email' => 'elena@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);

        DB::table('users')->insert([
            'id' => 11,
            'name' => 'Lorenzo',
            'slug' => Str::random($slugLength),
            'email' => 'lorenzo@maerp.app',
            'password' => '$2y$10$crLa4.YcqNmUD5/y9Gi2e.iKNolvCiBJnG26SIfZwJxPJs0xwUdGS',
        ]);
    }
}
