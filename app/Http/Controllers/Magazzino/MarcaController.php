<?php

namespace App\Http\Controllers\Magazzino;

use Illuminate\Http\Request;
use App\Models\Magazzino\Marca;
use App\Http\Controllers\Controller;

class MarcaController extends Controller
{
    public function index(){
        $marche = Marca::get();
        return view('magazzino.marche.index', [
            'marche' => $marche
        ]);
    }

    public function create(){
        return view('magazzino.marche.create');
    }

    public function store(Request $request){
        
        $this->validation($request);

        $nuovaMarca = new Marca;
        $nuovaMarca->nome = $request['nome'];
        $nuovaMarca->save();
        return redirect()->route('marche.index')->with('success', 'La marca è stata creata');
    }

    public function edit($marcaId){
        $marca = Marca::find($marcaId);
        return view('magazzino.marche.edit', [
            'marca' => $marca
        ]);
    }

    public function update(Request $request, $marcaId){
        $this->validation($request);
        $marca = Marca::findOrFail($marcaId);
        $marca->nome = $request['nome'];
        $marca->update();
        return redirect()->route('marche.index')->with('success', 'La marca è stata aggiornata');
    }

    public function destroy($marcaId){
        Marca::findOrFail($marcaId)->delete();
        return redirect()->route('marche.index')->with('success', 'La marca è stata cancellata');
    }


    protected function validation(Request $request){
        $request->validate([
            'nome' => 'unique:magazzino_marche|required|max:255'
        ],
        [
            'nome.unique:magazzino_marche' => 'Questa marca è già stata utilizzata',
            'nome.required' => 'Il campo nome marca è richiesto',
            'nome.max:255' => 'Il nome è troppo lungo',
        ]);
    }
}
