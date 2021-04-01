<?php

namespace App\Models\Magazzino;

use App\Models\Magazzino\Lotto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marca extends Model
{
    use HasFactory;

    protected $table= "magazzino_marche";

    public function lotti(){
        return $this->hasMany(Lotto::class);
    }
}
