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
            $cliente = $u->clienti()->findOrFail($fatturazione->cliente_id);
        } else {
            $cliente = Cliente::findOrFail($fatturazione->cliente_id);
        }



        if ($u->getRoleNames()[0] != 'agente'){
            // Acube
            $invoicePostUiid = null;

            if($fatturazione->fattura_elettronica){
                $request['fattura_elettronica'] = 1; // setto true per DB
                if($acube){
                    if( $acube->creaFatturaElettronica($fatturazione) ){
                        $invoicePostUiid = $acube->invoicePostUiid;
                    } else {
                        return back()->withErrors(['error' => [$acube->error]])->withInput();
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
                ['importo_totale_articolo' =>  $fatturazione->totale],
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

    public function edit($id){

        // filter by roles
        $u = auth()->user();

        if ($u->getRoleNames()[0] == 'agente'){
            $fattura = $u->fatture()->with('cliente', 'articoli')->findOrFail($id);
        } else {
            $fattura = Fattura::with('articoli', 'cliente')->findOrFail($id);
        }


        $canCreareFatture = auth()->user()->can('creare-fatture');
        return view('fatture.edit', [
            'fattura' => $fattura,
            'canCreareFatture' => $canCreareFatture
        ]);
    }

    public function update(Request $request, $fatturaId){

        $fatturazione = new Fatturazione($request);
        $fatturazione->handle();

        if($fattura->uuid){
            return redirect()->route('fatture.index')->with('error', 'Non è possibile modificare questa fattura');
        }

        $invoicePostUiid = null;
        
        // filter by roles
        $u = auth()->user();
        if ($u->getRoleNames()[0] == 'agente'){
            $cliente = $u->clienti()->findOrFail($fatturazione->cliente_id);
        } else {
            $cliente = Cliente::findOrFail($fatturazione->cliente_id);
        }


        // true per DB
        $request['includi_marca_da_bollo'] = $request['includi_marca_da_bollo'] ? true : false;
        $request['includi_metodo_pagamento'] = $request['includi_metodo_pagamento'] ? true : false;

        $fatturaDaAggiornare = Fattura::findOrFail($fatturaId);
        
        $fatturaDaAggiornare->update( array_merge(
            $request->only([
                'tipo_documento', 'fattura_elettronica', 'cliente_id', 'numero', 'data', 'lingua', 'valuta', 'note_documento', 'el_codice_destinatario', 
                'el_indirizzo_pec', 'el_esigibilita_iva', 'el_emesso_in_seguito_a', 'el_metodo_pagamento', 'el_nome_istituto_di_credito', 
                'el_iban', 'el_nome_beneficiario', 'documento_di_trasporto', 'includi_marca_da_bollo', 'costo_bollo', 'includi_metodo_pagamento',
                'metodo_pagamento', 'numero_ddt', 'data_ddt', 'numero_colli_ddt', 'peso_ddt', 'casuale_trasporto', 'trasporto_a_cura_di',
                'luogo_destinazione', 'annotazioni'
            ]),
                ['importo_totale_articolo' =>  $fatturazione->totale],
                ['uuid' =>  $invoicePostUiid]
            )
        );
    
        // Cancello gli articoli e li risalvo
        foreach ($fatturaDaAggiornare->articoli as $articolo) {
            $fatturaDaAggiornare->articoli()->detach($articolo->id);
            $articolo->delete();
        }
  
        $fatturaDaAggiornare->articoli()->createMany($fatturazione->articoli);

        return redirect()->route('fatture.index')->with('success', 'La fattura è stata modificata');


    }

    public function destroy($fatturaId){
        $fattura = Fattura::findOrFail($fatturaId);
        if($fattura->uuid){
            return redirect()->route('fatture.index')->with('error', 'Non è possibile cancellare questa fattura');
        }
        
        $fattura->articoli()->delete();
        $fattura->articoli()->detach();
        $fattura->delete();
        return redirect()->route('fatture.index')->with('success', 'La fattura è stata cancellata');
    }



    public function convertiFattura(Request $request){
        $data = $request->validate([
            'fattura_id' => 'required',
            'converti' => 'required',
        ]);

        $datiAmmessi = ['preventivo', 'ordine', 'proforma', 'fattura'];

        if(!in_array($data['converti'], $datiAmmessi)){
            return back()->withErrors(['error' => ['Qualcosa è andato storto nella clonazione del documento']]); 
        }

        if (auth()->user()->getRoleNames()[0] == 'agente'){
            if($data['converti'] == 'ordine' || $data['converti'] == 'fattura'){
                return back()->withErrors(['error' => ['Qualcosa è andato storto nella clonazione del documento']]);
            }
        }

        $fattura = Fattura::with('articoli')->findOrFail($data['fattura_id']);

        // replico con -tipo_documento-
        $clonaFattura = $fattura->replicate()->fill([
            'tipo_documento' => $data['converti']
        ]);
        $clonaFattura->save();

        // attacco gli stessi articoli - meglio crearli di nuovi:
        // $articoliIds = $fattura->articoli()->pluck('articoli.id');
        // $clonaFattura->articoli()->attach($articoliIds);

        // clono gli articoli
            foreach ($fattura->articoli as $articolo) {
                $clonaFattura->articoli()->create([
                    'lotto_id' => $articolo->lotto_id,
                    'codice' => $articolo->codice,
                    'quantita' => $articolo->quantita,
                    'unita_di_misura' => $articolo->unita_di_misura,
                    'descrizione' => $articolo->descrizione,
                    'prezzo_netto' => $articolo->prezzo_netto,
                    'iva' => $articolo->iva,
                    'importo_netto' => $articolo->importo_netto,
                    'costo_iva_articolo' => $articolo->costo_iva_articolo,
                    'importo_totale_articolo' => $articolo->importo_totale_articolo,
                ]);
            }


        return redirect()->route('fatture.index')->with('success', 'Il documento ' . $data['converti'] . ' è stato creato');
    }
}
