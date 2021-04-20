<?php

namespace App\Models\Blackbox;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LavorazioneOperatore extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'blackbox_lavorazione_operatore';
}
