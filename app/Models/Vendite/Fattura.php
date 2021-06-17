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


    const DOC_CONSENTITI = ['preventivo', 'ordine', 'proforma', 'fattura', 'ddt', 'nota_di_credito'];
    const TEST_INVIA_PDF_A_DESTINATARIO = false;

    public function articoli(){
        return $this->hasMany(Articolo::class);
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
