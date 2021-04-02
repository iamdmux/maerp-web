<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CapiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('blackbox_capi')->insert([
            'nome' => 'manica lunga',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 't-shirt',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'pantaloni',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'intimo',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'accessori',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'felpe',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'giacchette',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'giubbotti',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'tutine',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'vestiti',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'pant/gonne',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'constumi',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'due pezzi',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'leggins',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'camicie',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'scarpe',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'body',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'gilet',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'mix',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'sciarpe',
            'tipo' => 'bambino',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'jeans',
            'tipo' => 'bambino',
        ]);



        
        DB::table('blackbox_capi')->insert([
            'nome' => 'pantaloni',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'gonne / pantaloni',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 't-shirt',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'camicie',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'vestiti',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'giacche',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'acc',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'mix',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'cardigan',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'scarpe',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'manica lunga',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'manica lunga pesante',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'jeans',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'giubbotti',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'costumi',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'intimo',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'firmato mix',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'bambino',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'borse',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'leggins',
            'tipo' => 'adulto',
        ]);
        DB::table('blackbox_capi')->insert([
            'nome' => 'camicie uomo',
            'tipo' => 'adulto',
        ]);
    }
}
