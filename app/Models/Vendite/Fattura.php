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
    const ZERO_PERCENTO_INFO = [
        'N1' => 'N1 – escluse ex art. 15',
        'N2.1' => 'N2.1 non soggette ad IVA ai sensi degli artt. da 7 a 7-septies del DPR 633/72',
        'N2.2' => 'N2.2 non soggette – altri casi',
        'N3.1' => 'N3.1 non imponibili – esportazioni',
        'N3.2' => 'N3.2 non imponibili – cessioni intracomunitarie',
        'N3.3' => 'N3.3 non imponibili – cessioni verso San Marino',
        'N3.4' => 'N3.4 non imponibili – operazioni assimilate alle cessioni all’esportazione',
        'N3.5' => 'N3.5 non imponibili – a seguito di dichiarazioni d’intento',
        'N3.6' => 'N3.6 non imponibili – altre operazioni che non concorrono alla formazione del plafond',
        'N4' => 'N4 – esenti',
        'N5' => 'N5 – regime del margine / IVA non esposta in fattura',
        'N6.1' => 'N6.1 inversione contabile – cessione di rottami e altri materiali di recupero',
        'N6.2' => 'N6.2 inversione contabile – cessione di oro e argento puro',
        'N6.3' => 'N6.3 inversione contabile – subappalto nel settore edile',
        'N6.4' => 'N6.4 inversione contabile – cessione di fabbricati',
        'N6.5' => 'N6.5 inversione contabile – cessione di telefoni cellulari',
        'N6.6' => 'N6.6 inversione contabile – cessione di prodotti elettronici',
        'N6.7' => 'N6.7 inversione contabile – prestazioni comparto edile e settori connessi',
        'N6.8' => 'N6.8 inversione contabile – operazioni settore energetico',
        'N6.9' => 'N6.9 inversione contabile – altri casi'
    ];
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
