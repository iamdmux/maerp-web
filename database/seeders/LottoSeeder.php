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
            'codice_articolo' => 'abcdefg',
            'marca_id' => 1,
            'stagione' => 'primavera',
            'tipologia' => 'uomo',
            'quantita' => 2,
            'kg' => 2,
            'shop_descrizione' => 'Lorem ipsum, dolor sit, amet consectetur adipisicing elit. Vitae exercitationem porro saepe ea harum corrupti vero id laudantium enim, libero blanditiis expedita cupiditate a est.'
        ]
    );
    }
}
