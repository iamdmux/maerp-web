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
        // filter by roles
        $u = auth()->user();

        if ($u->getRoleNames()[0] == 'agente'){
            $fatture = $u->fatture()->with('cliente', 'articoli')->paginate(50);
        } else {
            $fatture = Fattura::with('cliente', 'articoli')->paginate(50);
        }
                
        return view('fatture.index', [
            'fatture' => $fatture
        ]);
    }

    public function create(){
        $canCreareFatture = auth()->user()->can('creare-fatture');
        return view('fatture.create', [
            'canCreareFatture' => $canCreareFatture
        ]);
    }

    public function store(FatturaPostRequest $request, Acube $acube){

        $fatturazione = new Fatturazione($request);
        $fatturazione->handle();


        // filter by roles
        $u = auth()->user();
        if ($u->getRoleNames()[0] == 'agente'){
            $cliente = $u->clienti()->findOrFail($clienteId);
        } else {
            $cliente = Cliente::findOrFail($fatturazione->cliente_id);
        }



        if ($u->getRoleNames()[0] != 'agente'){
            // Acube
            $invoicePostUiid = null;

            if($fatturazione->fattura_elettronica){
                $request['fattura_elettronica'] = 1; // setto true per DB
                if($acube){
                    // MEGLIO TRY CATCH
                    if( $acube->creaFatturaElettronica($fatturazione) ){
                        $invoicePostUiid = $acube->invoicePostUiid;
                    } else {
                        return back()->withErrors(['error' => ['Errore nella creazione della fattura elettronica']])->withInput();
                    };
                }
            }
        }

        // true per DB
        $request['includi_marca_da_bollo'] = $request['includi_marca_da_bollo'] ? true : false;
        $request['includi_metodo_pagamento'] = $request['includi_metodo_pagamento'] ? true : false;

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

        // filter by roles
        $u = auth()->user();

        if ($u->getRoleNames()[0] == 'agente'){
            $fattura = $u->fatture()->with('cliente', 'articoli')->findOrFail($id);
        } else {
            $fattura = Fattura::with('articoli', 'cliente')->findOrFail($id);
        }

        $canCreareFatture = auth()->user()->can('creare-fatture');
        return view('fatture.show', [
            'fattura' => $fattura,
            'canCreareFatture' => $canCreareFatture
        ]);
    }
}
