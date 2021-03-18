<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(){
        $clienti = Cliente::get();
        return view('clienti.index', [
            'clienti' => $clienti
        ]);
    }

    public function create(){
        return view('clienti.create');
    }

    public function store(Request $request){
        
        $data = $this->validation($request);

        Cliente::create($data);
        return redirect()->route('clienti.index')->with('success', 'Un nuovo cliente è stato creato');
    }

    public function validation(Request $request){
        return $request->validate([
            'denominazione' => 'required',
            'codice_sdi' => '',
            'tipologia' => '',
            'referente' => '',
            'partita_iva' => '',
            'paese' => '',
            'indirizzo' => '',
            'citta' => '',
            'cap' => '',
            'provincia' => '',
            'note_indirizzo' => '',
            'codice_interno' => '',
            'email' => '',
            'pec' => '',
            'telefono' => '',
            'note_extra' => '',
            'aliquota_iva' => '',
            'termini_pagamento' => '',
            'termini_tipo' => '',
            'metodo_pagamento_predef' => '',
            'iban' => '',
            'fax' => '',
            'indirizzo_spedizione' => '',
        ]);
    }
}
