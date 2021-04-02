<?php

namespace App\Http\Controllers\Blackbox;

use Illuminate\Http\Request;
use App\Models\Blackbox\Capo;
use App\Http\Controllers\Controller;

class CapoController extends Controller
{
    public function index(){
        $capiAdulto = Capo::where('tipo', 'adulto')->get();
        $capiBambini =  Capo::where('tipo', 'bambino')->get();
        return view('blackbox.capi.index', [
            'capiAdulto' => $capiAdulto,
            'capiBambini' => $capiBambini
        ]);
    }

    public function create(){
        return view('blackbox.capi.create');
    }

    public function store(Request $request){
        
        $request->validate(['nome' => 'required|max:255', 'tipo' => 'required|max:255',]);

        $nuovoCapo = new Capo;
        $nuovoCapo->nome = $request['nome'];
        $nuovoCapo->tipo = $request['tipo'];
        $nuovoCapo->save();
        return redirect()->route('capi.index')->with('success', 'Il nuovo capo è stato aggiunto');
    }

    public function edit($id){
        $capo = Capo::findOrFail($id);
        return view('blackbox.capi.edit',  [
            'capo' => $capo
        ]);
    }

    public function update(Request $request, $id){
        $request->validate(['nome' => 'required|max:255', 'tipo' => 'required|max:255',]);
        $capo = Capo::findOrFail($id);
        $capo->nome = $request['nome'];
        $capo->tipo = $request['tipo'];
        $capo->update();
        return redirect()->route('capi.index')->with('success', 'Il capo è stato modificato');
    }

    public function destroy($id){
        Capo::findOrFail($id)->delete();
        return redirect()->route('capi.index')->with('success', 'il capo è stato cancellato');
    }
}
