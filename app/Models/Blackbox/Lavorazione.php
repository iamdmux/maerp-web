<?php

namespace App\Models\Blackbox;

use Carbon\Carbon;
use App\Models\Blackbox\Capo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lavorazione extends Model
{
    use HasFactory;
    protected $table = 'blackbox_lavorazioni';
    protected $guarded = [];

    

    /*----------------------------
     blackbox_lavorazioni:     | id  | data |
    ----------------------------

    -----------------------------
    blackbox_operatori:         | id  | nome |
    -----------------------------

    ----------------------------
     blackboxlavorazione_capo:  | lavorazione_id | capo_id | 
     model: LavorazioneCapo
    

    **
    lavorazione della giornata con tutti i capi
    ----------------------------
    
    ----------------------------
     blackboxlavorazionecapo_operatore:         | operatore_id | lavorazionecapo_id | counter |
     relazione: lavorazione_capo e operatore 
     Model: LavorazioneCapo
    

    **
    Contatore per le lavorazioni degli operatori
    ----------------------------
    
    ----------------------------
      blackboxlavorazione_operatore:        | lavorazione_id | operatore_id | dalle | alle | tipo |
      
      
      **
      segno le pause
    ----------------------------*/

    public function capoLavorati(){
        return $this->belongsToMany(Capo::class, 'blackboxlavorazione_capo');
    }


    public function getDataAttribute($date){
        return Carbon::parse($date)->format('d-m-Y');
    }
}
