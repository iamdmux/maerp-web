<?php

namespace App\Http\Controllers\Vendite;

use App\Fatturazione\Acube;
use Illuminate\Http\Request;
use App\Models\Vendite\Cliente;
use App\Models\Vendite\Fattura;
use App\Fatturazione\Fatturazione;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\FatturaPostRequest;
use Barryvdh\Debugbar\Facade as Debugbar;

class FatturaController extends Controller
{
    public function index(){
        // filter by roles
        $u = auth()->user();

        if ($u->getRoleNames()[0] == 'agente'){
            $fatture = $u->fatture()->with('cliente', 'articoli')->orderBy('numero', 'DESC')->paginate(50);
        } else {
            $fatture = Fattura::with('cliente', 'articoli')->orderBy('numero', 'DESC')->paginate(50);
        }

        return view('fatture.index', [
            'fatture' => $fatture,
        ]);
    }

    public function create(){
        $canCreareFatture = auth()->user()->can('creare-fatture');
        $fatturaNextCounter = Fattura::fatturaNextCounter();
        return view('fatture.create', [
            'canCreareFatture' => $canCreareFatture,
            'fatturaNextCounter' => $fatturaNextCounter
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
        
        // Check tipo_documento
        $docConsenti = Fattura::DOC_CONSENTITI;
        if(!in_array($fatturazione->tipo_documento, $docConsenti)){
            return back()->withErrors(['error' => 'tipo di documento non valido'])->withInput();
        }

        // Acube
        $invoicePostUiid = null;
        
        if ($u->getRoleNames()[0] != 'agente'){
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

        // fix checkbox true / false  per DB
        
        // $request['includi_marca_da_bollo'] = $request['includi_marca_da_bollo'] ? true : false;
        // $request['includi_metodo_pagamento'] = $request['includi_metodo_pagamento'] ? true : false;
        // $request['documento_di_trasporto'] = $request['documento_di_trasporto'] == 'true' ? true : false; // qua c'è un hidden input
        // dd($request['documento_di_trasporto']);

        $nuovaFattura = Fattura::create( array_merge(
            $request->only([
                'tipo_documento', 'fattura_elettronica', 'cliente_id', 'numero', 'data', 'lingua', 'valuta', 'note_documento', 'el_codice_destinatario', 
                'el_indirizzo_pec', 'el_esigibilita_iva', 'el_emesso_in_seguito_a', 'el_metodo_pagamento', 'el_nome_istituto_di_credito', 
                'el_iban', 'el_nome_beneficiario', 'documento_di_trasporto', 'includi_marca_da_bollo', 'costo_bollo', 'includi_metodo_pagamento',
                'includi_note_pagamento', 'note_pagamento', 'metodo_pagamento', 'numero_ddt', 'data_ddt', 'numero_colli_ddt', 'peso_ddt', 'casuale_trasporto',
                'trasporto_a_cura_di', 'luogo_destinazione', 'annotazioni'
            ]),
                ['importo_totale' =>  $fatturazione->totale],
                ['uuid' =>  $invoicePostUiid],
                ['user_id' => auth()->id()]
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

        //converto gli articoli similmente agli input array del form 'articolo'
        $articoliConv = [];
            foreach($fattura->articoli as $articolo){

                $articoliConv['lotto_id'][] = $articolo->lotto_id;
                $articoliConv['codice'][] = $articolo->codice;
                
                $articoliConv['quantita'][] = $articolo->quantita;
                $articoliConv['unita_di_misura'][] = $articolo->unita_di_misura;
                $articoliConv['descrizione'][] = $articolo->descrizione;
                $articoliConv['prezzo_netto'][] = $articolo->prezzo_netto;
                $articoliConv['iva'][] = $articolo->iva;
                $articoliConv['importo_netto'][] = $articolo->importo_netto;
                $articoliConv['costo_iva_articolo'][] = $articolo->costo_iva_articolo;
                $articoliConv['importo_totale_articolo'][] = $articolo->importo_totale_articolo;

            };


        $canCreareFatture = auth()->user()->can('creare-fatture');
        return view('fatture.show', [
            'fattura' => $fattura,
            'canCreareFatture' => $canCreareFatture,
            'test_invia_pdf' => Fattura::TEST_INVIA_PDF_A_DESTINATARIO,
            'articoliConv' => $articoliConv
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

        if($fattura->uuid){
            return redirect()->route('fatture.index')->withErrors(['Non è possibile modificare questa fattura']);
        }


        //converto gli articoli similmente agli input array del form 'articolo'
        $articoliConv = [];
            foreach($fattura->articoli as $articolo){

                $articoliConv['lotto_id'][] = $articolo->lotto_id;
                $articoliConv['codice'][] = $articolo->codice;
                
                $articoliConv['quantita'][] = $articolo->quantita;
                $articoliConv['unita_di_misura'][] = $articolo->unita_di_misura;
                $articoliConv['descrizione'][] = $articolo->descrizione;
                $articoliConv['prezzo_netto'][] = $articolo->prezzo_netto;
                $articoliConv['iva'][] = $articolo->iva;
                $articoliConv['importo_netto'][] = $articolo->importo_netto;
                $articoliConv['costo_iva_articolo'][] = $articolo->costo_iva_articolo;
                $articoliConv['importo_totale_articolo'][] = $articolo->importo_totale_articolo;

            };

        $fatturaNextCounter = Fattura::fatturaNextCounter();
        $canCreareFatture = auth()->user()->can('creare-fatture');
        return view('fatture.edit', [
            'fattura' => $fattura,
            'canCreareFatture' => $canCreareFatture,
            'fatturaNextCounter' => $fatturaNextCounter,
            'articoliConv' => $articoliConv
        ]);
    }

    public function update(Request $request, $fatturaId){
        
        $fatturazione = new Fatturazione($request);
        $fatturazione->handle();
        
        if($fatturazione->uuid){
            return redirect()->route('fatture.index')->withErrors(['Non è possibile modificare questa fattura']);
        }

        $invoicePostUiid = null;
        
        // filter by roles
        $u = auth()->user();
        if ($u->getRoleNames()[0] == 'agente'){
            $cliente = $u->clienti()->findOrFail($fatturazione->cliente_id);
        } else {
            $cliente = Cliente::findOrFail($fatturazione->cliente_id);
        }


        // true checbox per DB
        // $request['includi_marca_da_bollo'] = $request['includi_marca_da_bollo'] ? true : false;
        // $request['includi_metodo_pagamento'] = $request['includi_metodo_pagamento'] ? true : false;
        // $request['documento_di_trasporto'] = $request['documento_di_trasporto'] == 'true' ? true : false; // qua c'è un hidden input

        $fatturaDaAggiornare = Fattura::findOrFail($fatturaId);
        
        $fatturaDaAggiornare->update( array_merge(
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
    
        // Cancello gli articoli e li risalvo
        foreach ($fatturaDaAggiornare->articoli as $articolo) {
            $fatturaDaAggiornare->articoli()->delete($articolo->id);
        }
  
        $fatturaDaAggiornare->articoli()->createMany($fatturazione->articoli);

        return redirect()->route('fatture.index')->with('success', 'La fattura è stata modificata');


    }

    public function destroy($fatturaId){
        $fattura = Fattura::findOrFail($fatturaId);
        if($fattura->uuid){
            return redirect()->route('fatture.index')->withErrors(['Non è possibile cancellare questa fattura']);
        }
        
        if($fattura->delete()){
            return redirect()->route('fatture.index')->with('success', 'La fattura è stata cancellata');
        } 

        return Log::error("Fattura $fatturaId è stata cancellata, vedere gli articoli" );
    }



    public function convertiFattura(Request $request){

        $data = $request->validate([
            'fattura_id' => 'required',
            'converti' => 'required',
        ]);

        
        $datiAmmessi = Fattura::DOC_CONSENTITI;

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
            'tipo_documento' => $data['converti'],
            'uuid' => null,
            'fattura_elettronica' => false
        ]);
        

        if($clonaFattura->save()){

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
        }

        return redirect()->route('fatture.index')->with('success', 'Il documento ' . $data['converti'] . ' è stato creato');
    }
}
