<?php

namespace App\Models\Vendite;

use Illuminate\Database\Eloquent\Model\Vendite;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fattura extends Model
{
    use HasFactory;

    protected $table = "fatture";
    protected $guarded = [];
}
