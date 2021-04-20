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
    protected $dates = ['data'];

    

    /*----------------------------
     blackboxlavorazionecapo_operatore => blackbox_counter
     blackboxlavorazione_operatore => blackbox_pause

    ----------------------------*/

    public function capiScelti(){
        return $this->belongsToMany(Capo::class, 'blackboxlavorazione_capo', 'lavorazione_id', 'capo_id')->withPivot('id');
    }

    public function getDataAttribute($date){
        return Carbon::parse($date)->format('d-m-Y');
    }

    public function getDataStringsAttribute(){
        return Carbon::parse($this->data)->isoFormat('dddd D MMMM Y');
    }

    public function operatori(){
        return $this->belongsToMany(Operatore::class, 'blackbox_lavorazione_operatore', 'lavorazione_id', 'operatore_id');
    }

    public function pauseLavorazione(){
        return $this->belongsToMany(Operatore::class, 'blackbox_pause', 'lavorazione_id', 'operatore_id')
        ->withPivot('id', 'dalle', 'alle', 'tipo');
    }
}
