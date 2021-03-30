<?php

namespace App\Models\Vendite;

use Carbon\Carbon;
use App\Models\Cliente;
use App\Models\Articolo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model\Vendite;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fattura extends Model
{
    use HasFactory;

    protected $table = "fatture";
    protected $guarded = [];


    public function articoli(){
        return $this->belongsToMany(Articolo::class, 'fattura_articolo', 'fattura_id', 'articolo_id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    
    public function getDataItaAttribute(){
        return Carbon::parse($this->data)->format('d-m-Y');
    }

    // public function getDateFormat(){
    //  return 'd-m-Y';
    // }
}
