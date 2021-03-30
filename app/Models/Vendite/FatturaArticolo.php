<?php

namespace App\Models\Vendite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FatturaArticolo extends Model
{
    use HasFactory;

    protected $table = 'fattura_articolo';
    protected $guarded = [];
    protected $timestamps = false;

}
