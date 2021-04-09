<?php

namespace App\Models\Blackbox;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blackbox\LavorazioneCapo;

class Operatore extends Model
{
    use HasFactory;

    protected $table = 'blackbox_operatori';
    // protected $dates = ['dalle', 'alle'];

    // public function getMinutiAttribute($date){
    //     return Carbon::parse($date)->isoFormat('dddd d MMMM Y');
    // }

    public function lavorazioneOperatore(){
        return $this->belongsToMany(LavorazioneCapo::class, 'blackboxlavorazionecapo_operatore', 'operatore_id', 'lavorazionecapo_id')->withPivot('counter');
    }
}
