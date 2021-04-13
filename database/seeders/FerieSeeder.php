<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blackbox_operatoreferie')->insert([
            'operatore_id' => 1,
            'dal' => Carbon::create('2021-01-01 08:30:00'),
            'al' => Carbon::create('2021-01-03 08:30:00'),
            'note' => 'Questa è una nota'
            
        ]);
        DB::table('blackbox_operatoreferie')->insert([
            'operatore_id' => 1,
            'dal' => Carbon::create('2021-02-01 08:30:00'),
            'al' => Carbon::create('2021-03-03 08:30:00'),
        ]);
        DB::table('blackbox_operatoreferie')->insert([
            'operatore_id' => 1,
            'dal' => Carbon::create('2022-01-01 08:30:00'),
            'al' => Carbon::create('2022-01-03 08:30:00'),
        ]);
    }
}
