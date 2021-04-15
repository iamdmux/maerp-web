<?php

namespace App\Models\Blackbox;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blackbox\LavorazioneCapo;

class Operatore extends Model
{
    use HasFactory;

    protected $table = 'blackbox_operatori';
    protected $guarded = [];

    // contatore lavorazione capi
    public function lavorazioneOperatore(){
        return $this->belongsToMany(LavorazioneCapo::class, 'blackboxlavorazionecapo_operatore', 'operatore_id', 'lavorazionecapo_id')->withPivot('counter');
    }

    public function ferie(){
        return $this->hasMany(OperatoreFerie::class);
    }
}
