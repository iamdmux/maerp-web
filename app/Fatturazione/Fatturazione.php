<?php
namespace App\Fatturazione;

use Carbon\Carbon;
use Illuminate\Support\Str;

class Fatturazione {

    public $request;

    public $totaleImponibile = 0.00;
    public $totaleIva = 0.00;
    public $totale = 0.00;
    public $articoli = [];

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

    // elettronica
    public $cliente_id;
    public $fattura_elettronica;
    public $denominazione;
    public $indirizzo;
    public $citta;
    public $cap;
    public $provincia;
    public $note_indirizzo;
    public $nazione;
    public $nazione_sigla;
    public $partita_iva;
    public $codice_fiscale;
    public $tipo_documento;
    public $el_codice_destinatario;
    public $el_indirizzo_pec;
    public $el_nome_istituto_di_credito;
    public $el_iban;
    public $el_nome_beneficiario;

    public function __construct($request){

        $this->request = $request;
        $this->tipo_documento = $request->tipo_documento;

        $this->note_documento = $request->note_documento;

        // metodo pagamento
        $this->includi_metodo_pagamento = $request->includi_metodo_pagamento ? true : false;
        $this->metodo_pagamento = $request->metodo_pagamento;

        // bollo
        $this->includi_marca_da_bollo = $request->includi_marca_da_bollo ? true : false;
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

        // elettronica
        $this->fattura_elettronica         = $request->fattura_elettronica ? true : false;
        $this->cliente_id                  = $request->cliente_id;
        $this->denominazione               = $request->denominazione;
        $this->indirizzo                   = $request->indirizzo;
        $this->citta                       = $request->citta;
        $this->cap                         = $request->cap;
        $this->provincia                   = $request->provincia;
        $this->note_indirizzo              = $request->note_indirizzo;
        $this->nazione                     = $request->nazione;
        $this->nazione_sigla               = $request->nazione_sigla;
        $this->partita_iva                 = $request->partita_iva;
        $this->codice_fiscale              = $request->codice_fiscale;
        $this->tipo_documento              = $request->tipo_documento;
        $this->el_codice_destinatario      = $request->el_codice_destinatario;
        $this->el_indirizzo_pec            = $request->el_indirizzo_pec;
        $this->el_nome_istituto_di_credito = $request->el_nome_istituto_di_credito;
        $this->el_iban                     = $request->el_iban;
        $this->el_nome_beneficiario        = $request->el_nome_beneficiario;
    }


    public function handle(){
        // $articoliLenght = count($this->request->codice);

        foreach ($this->request->codice as $key => $value) {
            $this->articoli[$key]['codice'] = $value;
        }
        foreach ($this->request->lotto_id as $key => $value) {
            $this->articoli[$key]['lotto_id'] = $value;
        }
        foreach ($this->request->quantita as $key => $value) {
            $this->articoli[$key]['quantita'] = $value;
        }
        foreach ($this->request->unita_di_misura as $key => $value) {
            $this->articoli[$key]['unita_di_misura'] = $value;
        }
        foreach ($this->request->prezzo_netto as $key => $value) {
            $this->articoli[$key]['prezzo_netto'] = $value;
        }
        foreach ($this->request->importo_netto as $key => $value) {
            $this->articoli[$key]['importo_netto'] = $value;
            // tot imponibile
            $this->totaleImponibile = ($this->totaleImponibile+(float)$value);
        }
        foreach ($this->request->descrizione as $key => $value) {
            $this->articoli[$key]['descrizione'] = $value;
        }
        foreach ($this->request->iva as $key => $value) {
            $this->articoli[$key]['iva'] = $value;
        }
        foreach ($this->request->costo_iva as $key => $value) {
            $this->articoli[$key]['costo_iva'] = $value;

            // tot iva
            $this->totaleIva = ($this->totaleIva+$value);
        }
        foreach ($this->request->importo_totale as $key => $value) {
            $this->articoli[$key]['importo_totale'] = $value;

            // totale
            $this->totale = ($this->totale+$value);
        }

        //bollo
        if($this->request->includi_marca_da_bollo){
            if(is_numeric($bol = str_replace(',', '.', $this->request->costo_bollo))){
                $this->totale = ($this->totale+$bol);
            }
        }
    }

}