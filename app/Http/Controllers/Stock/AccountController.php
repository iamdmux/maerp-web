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

        $data['stock_user_id'] = auth()->id();
        $data['user_id'] = auth()->id(); // può dare errore in fattura
        Cliente::create($data);
        return redirect()->route('stocks.home', app()->getLocale())->with('success', 'Il profilo è stato creato');
    }


    // public function show($id)
    // {
    //     //
    // }


    public function edit($lang, $slug){
        $user = auth()->user()->where('slug', $slug)->first();
        if($user){
            if($slug !== $user->slug || !$user->account()->exists()){
                return back();
            }
        
            return view('stocks.account.create-edit', [
                'userAccount' => auth()->user()->account,
                'edit' => true,
                'tipologia' => Cliente::TIPOLOGIA,
                'nazioniArray' => help_country_iso3166()
            ]);
        }
        abort(404);
    }

    public function update(Request $request, $slug){
        $data = $this->validation($request);

        $user = auth()->user()->where('slug', $slug)->first();
        if($user){

            if($slug !== $user->slug || !$user->account()->exists()){
                return back();
            }
        
            if($slug == $user->slug){
                $user->account()->update($data);
            } else {
                return back()->withErrors(['error' => ["Qualcosa è andato storto"]]); 
            }

            return redirect()->route('stocks.home', app()->getLocale())->with('success', 'Il profilo è stato aggiornato');
        }
        abort(404);
    }


    // public function destroy($id)
    // {
    //     //
    // }

    public function validation(Request $request){
        return $request->validate([
            'user_id'                   => 'nullable',
            'denominazione'             => 'required',
            'codice_sdi'                => 'nullable',
            'tipologia'                 => 'nullable',
            'referente'                 => 'nullable',
            'partita_iva'               => 'required',
            'codice_fiscale'            => 'nullable',
            'nazione'                   => 'required',
            'nazione_sigla'             => 'required',
            'indirizzo'                 => 'required',
            'citta'                     => 'required',
            'cap'                       => 'required',
            'provincia'                 => 'nullable',
            'note_indirizzo'            => 'nullable',
            'email'                     => 'required',
            'pec'                       => 'nullable',
            'telefono'                  => 'nullable',
            'note_extra'                => 'nullable|max:40000',
            'aliquota_iva'              => 'nullable',
            'termini_pagamento'         => 'nullable',
            'termini_tipo'              => 'nullable',
            'metodo_pagamento_predef'   => 'nullable',
            'iban'                      => 'nullable',
            'indirizzo_spedizione'      => 'nullable',
        ]);
    }
}
