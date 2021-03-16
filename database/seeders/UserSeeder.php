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
            'name' => 'DavideM',
            'email' => 'davidemarchiori.dev@gmail.com',
            'password' => '$2y$10$hItalZfJJ5TnmRER/euBX.vM000uMUhGfSj0H9D7fqivmRD/K5B96',
        ]);
        
        DB::table('users')->insert([
            'name' => 'Diego de Maio',
            'email' => 'ceo@gymia.io',
            'password' => Hash::make('$2y$10$JjBSQ2GBhyFY3Ce5qIT2AeF3jOaWJs6YPU0av5JFqq2pMqVNIst86'),
        ]);
    }
}
