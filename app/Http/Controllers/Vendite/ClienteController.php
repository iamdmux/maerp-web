<?php
namespace App\Http\Controllers\Vendite;


use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Vendite\Cliente;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{
    public function index(){

        // filter by roles
        if (auth()->user()->getRoleNames()[0] == 'agente'){
            $clienti = auth()->user()->clienti()->paginate(100);
        } else {
            $clienti = Cliente::with('user')->paginate(100);
        }

        return view('clienti.index', [
            'clienti' => $clienti
        ]);
    }

    public function create(){
        $listaAgenti = User::whereHas('roles', function($q){
            $q->where('name', 'agente');
        })->get();

        return view('clienti.show-create-edit', [
            'create' => true,
            'tipologia' => Cliente::TIPOLOGIA,
            'listaAgenti' => $listaAgenti
        ]);
    }

    public function show($clienteId){
        // filter by roles
        if (auth()->user()->getRoleNames()[0] == 'agente'){
            $cliente = auth()->user()->clienti()->findOrFail($clienteId);
        } else {
            $cliente = Cliente::findOrFail($clienteId);
        }

        $listaAgenti = User::whereHas('roles', function($q){
            $q->where('name', 'agente');
        })->get();

        return view('clienti.show-create-edit', [
            'show' => true,
            'tipologia' => Cliente::TIPOLOGIA,
            'cliente' => $cliente,
            'listaAgenti' => $listaAgenti
        ]);
    }

    public function store(Request $request){
        $data = $this->validation($request);

        if (auth()->user()->getRoleNames()[0] == 'agente'){
            $data['user_id'] = auth()->id();
        } 
        // else: l'user_id è nella select
        
        Cliente::create($data);
        return redirect()->route('clienti.index')->with('success', 'Un nuovo cliente è stato creato');
    }

    public function edit($clienteId){
         // filter by roles
        if (auth()->user()->getRoleNames()[0] == 'agente'){
            $cliente = auth()->user()->clienti()->findOrFail($clienteId);
        } else {
            $cliente = Cliente::findOrFail($clienteId);
        }

        $listaAgenti = User::whereHas('roles', function($q){
            $q->where('name', 'agente');
        })->get();

        return view('clienti.show-create-edit', [
            'cliente' => $cliente,
            'edit' => true,
            'tipologia' => Cliente::TIPOLOGIA,
            'listaAgenti' => $listaAgenti
        ]);
    }

    public function update(Request $request, $clienteId){
        // filter by roles
        if (auth()->user()->getRoleNames()[0] == 'agente'){
            $cliente = auth()->user()->clienti()->findOrFail($clienteId);
        } else {
            $cliente = Cliente::findOrFail($clienteId);
        }

        if (auth()->user()->getRoleNames()[0] == 'agente'){
            $data['user_id'] = auth()->id();
        } 
        // else: l'user_id è nella select

        $cliente = Cliente::findOrFail($clienteId);
        $data = $this->validation($request);
        $cliente->update($data);
        return redirect()->route('clienti.index')->with('success', 'Il cliente è stato modificato');
    }

    public function destroy($clienteId){
        // filter by roles
        if (auth()->user()->getRoleNames()[0] == 'agente'){
            $cliente = auth()->user()->clienti()->findOrFail($clienteId);
        } else {
            $cliente = Cliente::findOrFail($clienteId);
        }

        $cliente->delete();
        return redirect()->route('clienti.index')->with('success', 'Il cliente è stato cancellato');
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
            'paese' => '',
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
            'fax' => '',
            'indirizzo_spedizione' => '',
        ]);
    }
}
