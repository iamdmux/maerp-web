<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PauseLavorazioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1 gennaio
        DB::table('blackboxlavorazione_operatore')->insert([
            'id' => 1,
            'lavorazione_id' => 1, 
            'operatore_id' => 1,
            'dalle' => Carbon::create('2021-01-01 08:30:00'),
            'alle' => Carbon::create('2021-01-01 08:35:10'),
            'tipo' => 'pausafunzionale'
        ]);
        DB::table('blackboxlavorazione_operatore')->insert([
            'id' => 2,
            'lavorazione_id' => 1, 
            'operatore_id' => 2,
            'dalle' => Carbon::create('2021-01-01 09:30:00'),
            'alle' => Carbon::create('2021-01-01 09:33:10'),
            'tipo' => 'bagno'
        ]);

        // 2 gennaio
        DB::table('blackboxlavorazione_operatore')->insert([
            'id' => 3,
            'lavorazione_id' => 2, 
            'operatore_id' => 1,
            'dalle' => Carbon::create('2021-01-01 08:35:00'),
            'alle' => Carbon::create('2021-01-01 08:39:10'),
            'tipo' => 'bagno'
        ]);
        DB::table('blackboxlavorazione_operatore')->insert([
            'id' => 4,
            'lavorazione_id' => 2, 
            'operatore_id' => 2,
            'dalle' => Carbon::create('2021-01-01 09:33:00'),
            'alle' => Carbon::create('2021-01-01 09:40:10'),
            'tipo' => 'pausafunzionale'
        ]);



        // 1 febbraio
        DB::table('blackboxlavorazione_operatore')->insert([
            'id' => 5,
            'lavorazione_id' => 3, 
            'operatore_id' => 1,
            'dalle' => Carbon::create('2021-02-01 08:30:00'),
            'alle' => Carbon::create('2021-02-01 08:35:10'),
            'tipo' => 'bagno'
        ]);
        DB::table('blackboxlavorazione_operatore')->insert([
            'id' => 6,
            'lavorazione_id' => 3, 
            'operatore_id' => 2,
            'dalle' => Carbon::create('2021-02-01 09:30:00'),
            'alle' => Carbon::create('2021-02-01 09:33:10'),
            'tipo' => 'bagno'
        ]);

        DB::table('blackboxlavorazione_operatore')->insert([
            'id' => 7,
            'lavorazione_id' => 3, 
            'operatore_id' => 3,
            'dalle' => Carbon::create('2021-02-01 09:30:00'),
            'alle' => Carbon::create('2021-02-01 09:33:10'),
            'tipo' => 'bagno'
        ]);

        // 2 febbraio
        DB::table('blackboxlavorazione_operatore')->insert([
            'id' => 8,
            'lavorazione_id' => 4, 
            'operatore_id' => 1,
            'dalle' => Carbon::create('2021-02-02 08:35:00'),
            'alle' => Carbon::create('2021-02-02 08:39:10'),
            'tipo' => 'bagno'
        ]);
        DB::table('blackboxlavorazione_operatore')->insert([
            'id' => 9,
            'lavorazione_id' => 4, 
            'operatore_id' => 2,
            'dalle' => Carbon::create('2021-02-02 09:33:00'),
            'alle' => Carbon::create('2021-02-02 09:40:10'),
            'tipo' => 'pausafunzionale'
        ]);
    }
}
