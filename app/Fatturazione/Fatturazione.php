<?php
namespace App\Fatturazione;

use Carbon\Carbon;
use Illuminate\Support\Str;

class Fatturazione {

    public $request;
    public $articoliArray = [];

    public $totaleImponibile = 0.00;
    public $totaleIva = 0.00;
    public $totale = 0.00;
    public $articoli;

    public $note_documento;
    public $includi_metodo_pagamento;
    public $metodo_pagamento;
    public $includi_marca_da_bollo;
    public $costo_bollo;
    public $numero;
    public $data;
    public $data_ddt;
    public $documento_di_trasporto;
    public $numero_ddt;
    public $casuale_trasporto;
    public $luogo_destinazione;
    public $trasporto_a_cura_di;
    public $peso_ddt;
    public $numero_colli_ddt;
    public $annotazioni;

    public function __construct($request){

        $this->request = $request;
        $this->tipo_documento = $request->tipo_documento;

        $this->note_documento = $request->note_documento;

        // metodo pagamento
        $this->includi_metodo_pagamento = $request->includi_metodo_pagamento;
        $this->metodo_pagamento = $request->metodo_pagamento;

        // //bollo
        $this->includi_marca_da_bollo = $request->includi_marca_da_bollo;
        $this->costo_bollo = $request->costo_bollo;

        // date
        $this->numero = $request->numero;
        $this->data = $request->data ? Carbon::createFromFormat('Y-m-d', $request->data)->format('d-m-Y') : null;
        $this->data_ddt = $request->data_ddt ? Carbon::createFromFormat('Y-m-d', $request->data_ddt)->format('d-m-Y') : null;

        // DDT
        $this->documento_di_trasporto = $request->documento_di_trasporto;
        $this->numero_ddt = $request->numero_ddt;
        $this->casuale_trasporto = $request->casuale_trasporto;
        $this->luogo_destinazione = $request->luogo_destinazione;
        $this->trasporto_a_cura_di = $request->trasporto_a_cura_di;
        $this->peso_ddt = $request->peso_ddt;
        $this->numero_colli_ddt = $request->numero_colli_ddt;
        $this->annotazioni = $request->annotazioni;
    }
    
    public function handle(){
        $i = 0;
        foreach ($this->request->all() as $field => $val) {
            // if(Str::of($field)->startsWith('articolo_id-')){
            //     $exp = explode("-", $field);
            //     $this->articoliArray[$exp[1]]['articolo_id'] = $val;
            // } lo prende da $nuovaFattura->articoli()->createMany
            if(Str::of($field)->startsWith('codice-')){
                $exp = explode("-", $field);
                $this->articoliArray[$exp[1]]['codice'] = $val;
            }
            if(Str::of($field)->startsWith('quantita-')){
                $exp = explode("-", $field);
                $this->articoliArray[$exp[1]]['quantita'] = $val;
            }
            if(Str::of($field)->startsWith('unita_di_misura-')){
                $exp = explode("-", $field);
                $this->articoliArray[$exp[1]]['unita_di_misura'] = $val;
            }
            if(Str::of($field)->startsWith('prezzo_netto-')){
                $exp = explode("-", $field);
                $this->articoliArray[$exp[1]]['prezzo_netto'] = $val;
            }
            if(Str::of($field)->startsWith('importo_netto-')){
                $exp = explode("-", $field);
                $this->articoliArray[$exp[1]]['importo_netto'] = $val;
                // tot imponibile
                $this->totaleImponibile = ($this->totaleImponibile + $val);
            }
            if(Str::of($field)->startsWith('descrizione-')){
                $exp = explode("-", $field);
                $this->articoliArray[$exp[1]]['descrizione'] = $val;
            }
            if(Str::of($field)->startsWith('iva-')){
                $exp = explode("-", $field);
                $this->articoliArray[$exp[1]]['iva'] = $val;
            }
            if(Str::of($field)->startsWith('costo_iva-')){
                $exp = explode("-", $field);
                $this->articoliArray[$exp[1]]['costo_iva'] = $val;
                // tot iva
                $this->totaleIva = ($this->totaleIva + $val);
            }
            if(Str::of($field)->startsWith('importo_totale-')){
                $exp = explode("-", $field);
                $this->articoliArray[$exp[1]]['importo_totale'] = $val;
                // totale
                $this->totale = $this->totale+$val;
            }
            $i++;
        }

        //bollo
        if($this->request->includi_marca_da_bollo){
            if(is_numeric($bol = str_replace(',', '.', $this->request->costo_bollo))){
                $this->totale = ($this->totale+$bol);
            }
        }
        $this->articoli = collect();
        $this->articoli->push($this->articoliArray);
        $this->articoli = $this->articoli->flatten(1);
        $this->articoli = $this->articoli->values()->all();

    }
}