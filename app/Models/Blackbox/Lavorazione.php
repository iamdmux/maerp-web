<?php

namespace App\Models\Blackbox;

use Carbon\Carbon;
use App\Models\Blackbox\Capo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blackbox\LavorazioneCapo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lavorazione extends Model
{
    use HasFactory;

    /*----------------------------
    blackbox_lavorazione: la preparazione della lavorazione del giorno. con data e foreign capi
    ----------------------------
    
    ----------------------------
    blackboxlavorazione_capo: lavorazione_id e capo_id: tutti i capi inseriti nella lavorazione
    ----------------------------
    
    ----------------------------
    blackboxlavorazione_user: lavorazione_id e user_id: counter 
    ----------------------------*/


    protected $table = 'blackbox_lavorazione';
    protected $guarded = [];

    public function lavorazioneConCapi(){
        return $this->belongsToMany(Capo::class, 'blackboxlavorazione_capo');
    }

    public function getDataAttribute($date){
        return Carbon::parse($date)->format('d-m-Y');
    }
}
