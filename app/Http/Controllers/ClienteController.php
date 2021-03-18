<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(){
        $clienti = auth()->user()->clienti;
        return view('clienti.index', [
            'clienti' => $clienti
        ]);
    }

    public function create(){
        return view('clienti.show-create-edit', [
            'create' => true,
            'tipologia' => Cliente::TIPOLOGIA
        ]); // show-create-edit
    }

    public function show($clienteId){
        $cliente = auth()->user()->clienti()->findOrFail($clienteId);
        return view('clienti.show-create-edit', [
            'show' => true,
            'tipologia' => Cliente::TIPOLOGIA,
            'cliente' => $cliente
        ]); // show-create-edit
    }

    public function store(Request $request){
        $data = $this->validation($request);
        $data['user_id'] = auth()->id();
        Cliente::create($data);
        return redirect()->route('clienti.index')->with('success', 'Un nuovo cliente è stato creato');
    }

    public function edit($clienteId){
        $cliente = auth()->user()->clienti()->findOrFail($clienteId);
        return view('clienti.show-create-edit', [
            'cliente' => $cliente,
            'edit' => true,
            'tipologia' => Cliente::TIPOLOGIA
        ]);
    }

    public function update(Request $request, $clienteId){
        $cliente = auth()->user()->clienti()->findOrFail($clienteId);
        $data = $this->validation($request);
        $data['user_id'] = auth()->id();
        $cliente->update($data);
        return redirect()->route('clienti.index')->with('success', 'Il cliente è stato modificato');
    }

    public function destroy($clienteId){
        $cliente = auth()->user()->clienti()->findOrFail($clienteId);
        $cliente->delete();
        return redirect()->route('clienti.index')->with('success', 'Il cliente è stato cancellato');
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
