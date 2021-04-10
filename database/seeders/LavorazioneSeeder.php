<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LavorazioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // gennaio
        DB::table('blackbox_lavorazioni')->insert([
            'id' => 1,
            'data' => Carbon::create('2021-01-01 08:30:00')
        ]);
        DB::table('blackbox_lavorazioni')->insert([
            'id' => 2,
            'data' => Carbon::create('2021-01-02 08:30:00')
        ]);

        // febbraio
        DB::table('blackbox_lavorazioni')->insert([
            'id' => 3,
            'data' => Carbon::create('2021-02-01 08:30:00')
        ]);
        DB::table('blackbox_lavorazioni')->insert([
            'id' => 4,
            'data' => Carbon::create('2021-02-02 08:30:00')
        ]);


        // CAPI
        DB::table('blackboxlavorazione_capo')->insert([
            'id' => 1,
            'lavorazione_id' => 1,
            'capo_id' => 22
        ]);

        DB::table('blackboxlavorazione_capo')->insert([
            'id' => 2,
            'lavorazione_id' => 2,
            'capo_id' => 26
        ]);

        DB::table('blackboxlavorazione_capo')->insert([
            'id' => 3,
            'lavorazione_id' => 3,
            'capo_id' => 14
        ]);

        DB::table('blackboxlavorazione_capo')->insert([
            'id' => 4,
            'lavorazione_id' => 4,
            'capo_id' => 8
        ]);
    }
}