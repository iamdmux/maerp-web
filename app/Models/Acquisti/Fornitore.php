<?php

namespace App\Models\Acquisti;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornitore extends Model
{
    use HasFactory;

    protected $table = 'fornitori';
    protected $guarded = [];
}
