<?php

namespace App\Models\Vendite;

use Carbon\Carbon;
use App\Models\Articolo;
use App\Models\Impostazione;
use App\Models\Vendite\Cliente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model\Vendite;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fattura extends Model
{
    use HasFactory;

    protected $table = "fatture";
    protected $guarded = [];
    protected $dates = ['data'];


    public function articoli(){
        return $this->belongsToMany(Articolo::class, 'fattura_articolo', 'fattura_id', 'articolo_id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    
    public function getDataItaAttribute(){
        return Carbon::parse($this->data)->format('d-m-Y');
    }

    public static function fatturaNextCounter(){
        $impostazioneNumerazione = Impostazione::find(1)->numerazione_fattura;
        if($ultimafattura = (new static)::where('tipo_documento', 'fattura')->orderBy('data', 'desc')->first()){
            $ultimaNumerazione = $ultimafattura->numero+1;

            if($ultimaNumerazione > $impostazioneNumerazione){
                return $ultimaNumerazione;
            }
            return $impostazioneNumerazione;
        }
        return $impostazioneNumerazione;
    }
}
