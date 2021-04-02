<?php

namespace App\Http\Controllers\Magazzino;

use Illuminate\Http\Request;
use App\Models\Magazzino\Operatore;
use App\Http\Controllers\Controller;

class OperatoreController extends Controller
{
    public function index(){
        $operatori = Operatore::get();
        return view('magazzino.operatori.index', [
            'operatori' => $operatori
        ]);
    }

    public function create(){
        return view('magazzino.operatori.create');
    }

    public function store(Request $request){
        
        $request->validate(['nome' => 'required|max:255']);

        $nuovaOperatore = new Operatore;
        $nuovaOperatore->nome = $request['nome'];
        $nuovaOperatore->save();
        return redirect()->route('operatori.index')->with('success', 'Il nuovo operatore è stato aggiunto');
    }

    public function edit($id){
        $operatore = Operatore::findOrFail($id);
        return view('magazzino.operatori.edit',  [
            'operatore' => $operatore
        ]);
    }

    public function update(Request $request, $id){
        $request->validate(['nome' => 'required|max:255']);
        $operatore = Operatore::findOrFail($id);
        $operatore->nome = $request['nome'];
        $operatore->update();
        return redirect()->route('operatori.index')->with('success', 'Il nuovo operatore è stato modificato');
    }

    public function destroy($id){
        Operatore::findOrFail($id)->delete();
        return redirect()->route('operatori.index')->with('success', 'L\'operatore è stato cancellato');
    }
}
