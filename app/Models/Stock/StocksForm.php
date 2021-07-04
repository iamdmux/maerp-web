<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StocksForm extends Model
{
    use HasFactory;
    
    protected $table = 'stocks_forms';

    protected $fillable = [
        'user_id',
        'nome',
        'cognome',
        'email',
        'azienda',
        'messaggio',
        'oggetto',
        'tipo_form'
    ];
}
