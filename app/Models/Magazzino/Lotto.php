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
        ['val' => 'abbigliamento donna',    'show'=> 'abbigliamento donna'],
        ['val' => 'abbigliameto uomo',      'show'=> 'abbigliameto uomo'],
        ['val' => 'abbigliamento bambino',  'show'=> 'abbigliamento bambino'],
        ['val' => 'abbigliamento mix',      'show'=> 'abbigliamento mix'],
        ['val' => 'abbigliamento difettato bambino', 'show'=> 'abbigliamento difettato bambino'],
        ['val' => 'abbigliamento difettato donna','show'=> 'abbigliamento difettato donna'],
        ['val' => 'abbigliamento difettato uomo','show'=> 'abbigliamento difettato uomo'],
        ['val' => 'abbigliamento difettato mix','show'=> 'abbigliamento difettato mix'],
        ['val' => 'accessori bambino',      'show'=> 'accessori bambino'],
        ['val' => 'accessori donna',        'show'=> 'accessori donna'],
        ['val' => 'accessori uomo',         'show'=> 'accessori uomo'],
        ['val' => 'accessori mix',          'show'=> 'accessori mix'],
        ['val' => 'intimo bambino',         'show'=> 'intimo bambino'],
        ['val' => 'intimo',                 'show'=> 'intimo'],
        ['val' => 'casa',                   'show'=> 'casa'],
        ['val' => 'borse',                  'show'=> 'borse'],
        ['val' => 'scarpe',                 'show'=> 'scarpe'],
        ['val' => 'cosmetica',              'show'=> 'cosmetica'],
        ['val' => 'buttare',                'show'=> 'buttare'],
        ['val' => 'elettronica',            'show'=> 'elettronica'],
        ['val' => 'buttare',                'show'=> 'buttare'],
        ['val' => 'cartoleria',             'show'=> 'cartoleria'],
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
        ->withTimestamps()
        ->withPivot('id', 'tipo');
    }

    public function usersCart(){
        return $this->belongsToMany(User::class, 'stocks_cart_user', 'lotto_id', 'user_id')
        ->withPivot('id', 'quantita', 'prezzo')
        ->withTimestamps();
    }

}
