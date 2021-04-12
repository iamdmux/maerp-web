<?php

namespace App\Models\Blackbox;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorePausa extends Model
{
    use HasFactory;

    protected $table = 'blackboxlavorazione_operatore';
    protected $dates = ['dalle', 'alle'];

    const OPERATORI_TIPI_DI_PAUSA = ['bagno', 'pausafunzionale'];
}
