<?php

namespace App\Models\Blackbox;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blackbox\LavorazioneCapo;

class Operatore extends Model
{
    use HasFactory;

    protected $table = 'blackbox_operatori';

    public function lavorazioneCapoCounter(){
        return $this->belongsToMany(LavorazioneCapo::class, 'blackboxlavorazionecapo_operatore', 'lavorazionecapo_id', 'operatore_id')->withPivot('counter');
    }
}
