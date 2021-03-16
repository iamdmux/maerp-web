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
            'password' => Hash::make('password0'),
        ],[
            'name' => 'Diego de Maio',
            'email' => 'ceo@gymia.io',
            'password' => Hash::make('password0'),
        ]
    );
    }
}
