<?php

namespace App\Models\Blackbox;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LavorazioneCapo extends Model
{
    use HasFactory;

    protected $table = 'blackboxlavorazione_capo';

    public function getDalleAttribute($date){
        return Carbon::parse($date)->format('Y');
    }
    public function operatoriCapiCounter(){
        return $this->belongsToMany(Operatore::class, 'blackboxlavorazionecapo_operatore', 'lavorazionecapo_id', 'operatore_id')->withPivot('counter');
    }
    
}
