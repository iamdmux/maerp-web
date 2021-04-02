<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperatoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blackbox_operatori')->insert(
            [
                'nome' => 'Borgo',
            ]
        );
        DB::table('blackbox_operatori')->insert(
            [
                'nome' => 'Lorena',
            ]);
        DB::table('blackbox_operatori')->insert(
            [
                'nome' => 'Maria',
            ]);
        DB::table('blackbox_operatori')->insert(
            [
                'nome' => 'Andreea',
            ]);
        DB::table('blackbox_operatori')->insert(
            [
                'nome' => 'Pillo',
            ]);
        DB::table('blackbox_operatori')->insert(
            [
                'nome' => 'Ale',
            ]);
        DB::table('blackbox_operatori')->insert(
            [
                'nome' => 'Maria 2',
            ]);
        DB::table('blackbox_operatori')->insert(
            [
                'nome' => 'Lorena',
            ]);
        DB::table('blackbox_operatori')->insert(
            [
                'nome' => 'Dicco',
            ]);
        DB::table('blackbox_operatori')->insert(
            [
                'nome' => 'Regy',
            ]);
        DB::table('blackbox_operatori')->insert(
            [
                'nome' => 'Kimu',
            ]);
        DB::table('blackbox_operatori')->insert(
            [
                'nome' => 'Liana',
            ]);
    }
}
