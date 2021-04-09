<?php

namespace App\Models\Blackbox;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorePausa extends Model
{
    use HasFactory;

    protected $table = 'blackboxlavorazionecapo_operatore';
    protected $dates = ['dalle', 'alle'];
}
