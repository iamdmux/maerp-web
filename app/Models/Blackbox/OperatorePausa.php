<?php

namespace App\Models\Blackbox;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorePausa extends Model
{
    use HasFactory;

    protected $table = 'blackboxlavorazione_operatore';
    public $timestamps = false;
    protected $dates = ['dalle', 'alle'];
    protected $fillable = ['alle', 'dalle'];

    const OPERATORI_TIPI_DI_PAUSA = ['bagno', 'pausafunzionale'];
}
