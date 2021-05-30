<?php

namespace App\Models\Magazzino;

use App\Models\User;
use App\Models\Stock\Order;
use App\Models\Magazzino\Marca;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Lotto extends Model
{
    use HasFactory;

    protected $table = "magazzino_lotti";

    protected $fillable = [
        'marca_id',
        'stagione',
        'tipologia',
        'kg',
        'quantita',
        'venditore',
        'codice_articolo',
        "in_shop",
        "shop_prezzo",
        "shop_descrizione",
        "visibilita",
        "nazioni_tranne",
        "shop_image",
        "shop_video"
    ];

    // protected $casts = ['nazioni_tranne' => 'json'];

    const TIPOLOGIA = [
        ['val' => 'uomo',           'show'=> 'Uomo'],
        ['val' => 'donna',          'show'=> 'Donna'],
        ['val' => 'bambino',        'show'=> 'Bambino'],
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
        ['val' => 'costumi',          'show'=> 'Costumi'],
    ];

    public static function cambiaQuantita($lotto, $quantita, $addOrRemove){
        if($addOrRemove == 'add'){
            $lotto->quantita = ($lotto->quantita+$quantita);
            $lotto->save();
            return true;
        }
        if($addOrRemove == 'remove'){
            $lotto->quantita = ($lotto->quantita-$quantita);
            if($lotto->quantita >= 0){
                $lotto->save();
                return true;
            }
            return back()->withErrors(['error' => ['Qualcosa è andato storto']]);
        }
        return back()->withErrors(['error' => ['Qualcosa è andato storto']]);
    }

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function status(){
        return $this->belongsToMany(User::class, 'magazzino_lotti_status', 'lotto_id', 'user_id')
        ->withPivot('id', 'tipo');
    }

    public function usersCart(){
        return $this->belongsToMany(User::class, 'stocks_cart_user', 'lotto_id', 'user_id')
        ->withPivot('id', 'quantita', 'prezzo')
        ->withTimestamps();
    }

}
