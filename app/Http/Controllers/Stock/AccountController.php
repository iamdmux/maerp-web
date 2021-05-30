<?php

namespace App\Http\Controllers\Stock;

use Illuminate\Http\Request;
use App\Models\Vendite\Cliente;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{

    // public function index()
    // {
    //     //
    // }


    public function create()
    {
        return view('stocks.account.create-edit', [
            'create' => true,
            'tipologia' => Cliente::TIPOLOGIA,
            'nazioniArray' => help_country_iso3166()
        ]);
    }


    public function store(Request $request){
        $data = $this->validation($request);
        $data['is_stocks_user'] = true;
        $data['stock_user_id'] = auth()->id();
        Cliente::create($data);
        return redirect()->route('stocks.home')->with('success', 'Il profilo è stato creato');
    }


    // public function show($id)
    // {
    //     //
    // }


    public function edit($id){

        $user = auth()->user();
        if($id !== $user->id || !$user->account()->exists){
            return back();
        }

        return view('stocks.account.create-edit', [
            'userAccount' => auth()->user()->account,
            'edit' => true,
            'tipologia' => Cliente::TIPOLOGIA,
            'nazioniArray' => help_country_iso3166()
        ]);
    }

    public function update(Request $request, $id){
        $data = $this->validation($request);

        $user = auth()->user();
        if($id !== $user->id || !$user->account()->exists){
            return back();
        }

        if($id == $user->id){
            $user->account()->update($data);
        } else {
            return back()->withErrors(['error' => ["Qualcosa è andato storto"]]); 
        }

        return redirect()->route('stocks.home')->with('success', 'Il profilo è stato aggiornato');
    }


    public function destroy($id)
    {
        //
    }

    public function validation(Request $request){
        return $request->validate([
            'user_id' => '',
            'denominazione' => 'required',
            'codice_sdi' => '',
            'tipologia' => '',
            'referente' => '',
            'partita_iva' => '',
            'codice_fiscale' => '',
            'nazione' => '',
            'nazione_sigla' => '',
            'indirizzo' => '',
            'citta' => '',
            'cap' => '',
            'provincia' => '',
            'note_indirizzo' => '',
            'email' => '',
            'pec' => '',
            'telefono' => '',
            'note_extra' => '',
            'aliquota_iva' => '',
            'termini_pagamento' => '',
            'termini_tipo' => '',
            'metodo_pagamento_predef' => '',
            'iban' => '',
            'indirizzo_spedizione' => '',
        ]);
    }
}
