<?php

namespace App\Http\Controllers\Vendite;

use App\Models\Vendite\Cliente;
use App\Fatturazione\Acube;
use Illuminate\Http\Request;
use App\Models\Vendite\Fattura;
use App\Fatturazione\Fatturazione;
use App\Http\Controllers\Controller;
use App\Http\Requests\FatturaPostRequest;

class FatturaController extends Controller
{
    public function index(){
        $fatture = Fattura::with('cliente', 'articoli')->paginate(50);
        return view('fatture.index', [
            'fatture' => $fatture
        ]);
    }

    public function create(){
        return view('fatture.create');
    }

    public function store(FatturaPostRequest $request, Acube $acube){

        // Acube
        $invoicePostUiid = null;

        if($request->fattura_elettronica){
            // setto true per DB
            $request['fattura_elettronica'] = 1;

            if($acube){
                // MEGLIO TRY CATCH
                if( $acube->creaFatturaElettronica($request) ){
                    $invoicePostUiid = $acube->invoicePostUiid;
                } else {
                    return back()->withErrors(['error' => ['Errore nella creazione della fattura elettronica']]);
                };
            }
        }

        $cliente = Cliente::findOrFail($request->cliente_id);
        $fatturazione = new Fatturazione($request);
        $fatturazione->handle();

        $nuovaFattura = Fattura::create( array_merge(
            $request->only([
                'tipo_documento', 'fattura_elettronica', 'cliente_id', 'numero', 'data', 'lingua', 'valuta', 'note_documento', 'el_codice_destinatario', 
                'el_indirizzo_pec', 'el_esigibilita_iva', 'el_emesso_in_seguito_a', 'el_metodo_pagamento', 'el_nome_istituto_di_credito', 
                'el_iban', 'el_nome_beneficiario', 'documento_di_trasporto', 'includi_marca_da_bollo', 'costo_bollo', 'includi_metodo_pagamento',
                'metodo_pagamento', 'numero_ddt', 'data_ddt', 'numero_colli_ddt', 'peso_ddt', 'casuale_trasporto', 'trasporto_a_cura_di',
                'luogo_destinazione', 'annotazioni'
            ]),
                ['importo_totale' =>  $fatturazione->totale],
                ['uuid' =>  $invoicePostUiid]
            )
        );
    
        $nuovaFattura->articoli()->createMany($fatturazione->articoli);

        return redirect()->route('fatture.index')->with('success', 'La fattura è stata creata');
    }

    public function show($id){
        $fattura = Fattura::with('articoli', 'cliente')->findOrFail($id);
        return view('fatture.show', [
            'fattura' => $fattura
        ]);
    }
}
