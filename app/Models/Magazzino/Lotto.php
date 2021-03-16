<?php

namespace App\Models\Magazzino;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotto extends Model
{
    use HasFactory;

    protected $table= "magazzino_lotti";

    protected $fillable = [
        'marca_id',
        'stagione',
        'tipologia',
        'kg',
        'quantita',
        'venditore',
        'codice_articolo'
    ];


    const TIPOLOGIA = [
        ['val' => 'uomo',           'show'=> 'Uomo'],
        ['val' => 'donna',          'show'=> 'Donna'],
        ['val' => 'bambino',        'show'=> 'Uomo'],
        ['val' => 'scarpe-bambino', 'show'=> 'Scarpe-Bambino'],
        ['val' => 'scarpe-adulto',  'show'=> 'Scarpe-Adulto'],
        ['val' => 'accessori',      'show'=> 'Accessori'],
        ['val' => 'intimo',         'show'=> 'Intimo'],
        ['val' => 'mix',            'show'=> 'Mix'],
        ['val' => 'difettato',      'show'=> 'Difettato'],
        ['val' => 'accessori-uomo', 'show'=> 'Accessori-Uomo'],
        ['val' => 'accessori-donna', 'show'=> 'Accessori-Donna'],
        ['val' => 'accessori-bambino', 'show'=> 'Accessori-Bambino'],
        ['val' => 'intimo-uomo',    'show'=> 'Intimo-Uomo'],
        ['val' => 'intimo-donna',   'show'=> 'Intimo-Donna'],
        ['val' => 'intimo-bambino', 'show'=> 'Intimo-Bambino'],
        ['val' => 'difettato-uomo',  'show'=> 'Difettato-Uomo'],
        ['val' => 'difettato-donna', 'show'=> 'Difettato-Donna'],
        ['val' => 'difettato-bambino', 'show'=> 'Difettato-Bambino'],
        ['val' => 'costumi',          'show'=> 'Donna'],
    ];
}
