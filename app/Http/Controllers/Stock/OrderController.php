<?php

namespace App\Http\Controllers\Stock;

use Illuminate\Http\Request;
use App\Models\Magazzino\Lotto;
use App\Models\Vendite\Fattura;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        $orders = auth()->user()->orders;
        $orders->load('items');

        return view('stocks.orders.index', [
            'orders' => $orders
        ]);
    }


    public function store(Request $request){
        $request->validate([
            'annotazioni' => 'nullable|max:15000'
        ]);

        if(!auth()->user()->account()->exists()){
            return back()->withErrors(['error' => ["E' possibile creare l'ordine dopo il completamento del profilo"]]); 
        }

        if(auth()->check()){

            $user = auth()->user();
            $cart = $user->cart;

            if(!$cart->count()){
                return back()->withErrors(['error' => ['Il tuo carrello è vuoto']]);    
            }

            //subtotal
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal = $subtotal+($item->pivot->prezzo*$item->pivot->quantita);
            }

            if($order = $user->orders()->create([
                'user_id' => $user->id,
                'subtotal' => $subtotal
            ])){
                foreach ($cart as $item) {
                    $order->items()->attach( $order->id, [
                        'lotto_id' => $item->pivot->lotto_id,
                        'quantita' => $item->pivot->quantita,
                    ]);
                }
                $user->cart()->detach();

                // CREA DOC ORDINE
                $this->creaFatturazioneOrdine($user, $subtotal, $request->annotazioni, $cart);

                return back()->with('success', "L'ordine è stato creato");
            }

            return back()->withErrors(['error' => ['Qualcosa è andato storto']]);   
        }
    }

    protected function creaFatturazioneOrdine($user, $subtotal, $annotazioni, $cart){

    $fatturaOrdine = Fattura::create([
            'tipo_documento' => 'ordine',
            'cliente_id' => $user->account->id,
            'numero' => Fattura::fatturaNextCounter(),
            'data' => today(),
            'lingua' => 'it',
            'valuta' => 'euro',
            'importo_totale' => $subtotal,
            'is_from_stocks' => true,
            'annotazioni' => $annotazioni
    ]);



    if($fatturaOrdine){
        foreach ($cart as $item) {
            $lotto = Lotto::find($item->pivot->lotto_id);
            if($lotto){
                $fatturaOrdine->articoli()->create([
                    'lotto_id' => $item->pivot->lotto_id,
                    'codice' => $lotto->codice_articolo,
                    'quantita' => $item->pivot->quantita,
                    'unita_di_misura' => $lotto->unita_di_misura,
                    // 'descrizione' => $lotto->descrizione,
        
                    'prezzo_netto' => $lotto->shop_prezzo,
                    'iva' => 22,
                    'importo_netto' => $lotto->shop_prezzo,
                    'costo_iva_articolo' => $iva = (($lotto->shop_prezzo/100)*22),
                    'importo_totale_articolo' => $lotto->shop_prezzo + $iva
                ]);
            }
        }
        // $fatturaOrdine->articoli()->createMany($fatturazione->articoli);
    }

    
        // $nuovaFattura = Fattura::create( array_merge(
        //     $request->only([
        //         'tipo_documento', 'fattura_elettronica', 'cliente_id', 'numero', 'data', 'lingua', 'valuta', 'note_documento', 'el_codice_destinatario', 
        //         'el_indirizzo_pec', 'el_esigibilita_iva', 'el_emesso_in_seguito_a', 'el_metodo_pagamento', 'el_nome_istituto_di_credito', 
        //         'el_iban', 'el_nome_beneficiario', 'documento_di_trasporto', 'includi_marca_da_bollo', 'costo_bollo', 'includi_metodo_pagamento',
        //         'includi_note_pagamento', 'note_pagamento', 'metodo_pagamento', 'numero_ddt', 'data_ddt', 'numero_colli_ddt', 'peso_ddt', 'casuale_trasporto',
        //         'trasporto_a_cura_di', 'luogo_destinazione', 'annotazioni'
        //     ]),
        //         ['importo_totale' =>  $fatturazione->totale],
        //         ['uuid' =>  $invoicePostUiid]
        //     )
        // );
    
        // $nuovaFattura->articoli()->createMany($fatturazione->articoli);
    }
}
