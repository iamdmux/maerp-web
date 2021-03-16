<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('magazzino_marche')->insert(
            [
                'id' => 1,
                'nome' => 'Zara',
            ],
        );
        DB::table('magazzino_marche')->insert(
            [
                'id' => 2,
                'nome' => 'Desigual',
            ],
        );

        DB::table('magazzino_marche')->insert(
            [
                'id' => 3,
                'nome' => 'Carpisa',
            ]
        );
    }
}
