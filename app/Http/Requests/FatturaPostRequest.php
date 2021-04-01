<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FatturaPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // inserire articoli validation array
        // foreach ($variable as $key => $value) {
        //     # code...
        // }
        // https://ericlbarnes.com/2015/04/04/laravel-array-validation/
        $rules =  [
            'tipo_documento' => '',
            'tab_show_cliente' => '',
            'tab_show_dati_documento' => '',
            'tab_show_contributi_ritenute' => '',
            'tab_show_opzioni_avanzate' => '',
            'tab_show_personalizzazione' => '',
            'tab_show_note_doc' => '',
            'quantiArticoli' => '',
            // cliente, solo per old()
            'denominazione' => '',
            'indirizzo' => '',
            'citta' => '',
            'cap' => '',
            'provincia' => '',
            'note_indirizzo' => '',
            'paese' => '',
            'partita_iva' => '',
            'codice_fiscale' => '',
            'tipo_documento' => '',

            'fattura_elettronica' => '',
            'cliente_id' => 'required',
            'numero' => 'required',
            'data' => '',
            'lingua' => '',
            'valuta' => '',
            'note_documento' => '',
            'el_codice_destinatario' =>'',
            'el_indirizzo_pec' =>'',
            'el_esigibilita_iva' =>'',
            'el_emesso_in_seguito_a' =>'',
            'el_metodo_pagamento' =>'',
            'el_nome_istituto_di_credito' => '',
            'el_iban' =>'',
            'el_nome_beneficiario' =>'',
            'documento_di_trasporto' =>'',
            'includi_marca_da_bollo' =>'',
            'costo_bollo' =>'',
            'includi_metodo_pagamento' =>'',
            'metodo_pagamento' =>'',
            'numero_ddt' =>'',
            'data_ddt' =>'',
            'numero_colli_ddt' =>'',
            'peso_ddt' => '',
            'casuale_trasporto' =>'',
            'trasporto_a_cura_di' =>'',
            'luogo_destinazione' =>'',
            'annotazioni' =>'',
            
            'lotto_id.*' => '',
            'codice.*' => 'required',
            'quantita.*' =>'',
            'unita_di_misura.*' =>'',
            'prezzo_netto.*' =>'',
            'descrizione.*' =>'',
            'importo_netto.*' =>'',
            'iva.*' =>'',
            'costo_iva.*' =>'',
            'importo_totale.*' =>'',
        ];
        return $rules;
    }
}
