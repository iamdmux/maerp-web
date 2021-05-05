<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LottoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('magazzino_lotti')->insert([
            'marca_id' => 1,
            'stagione' => 'primavera',
            'tipologia' => 'uomo',
            'quantita' => 2,
            'kg' => 2,
            'codice_articolo' => 'abc'
        ]
    );
    }
}
