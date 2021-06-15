<?php

namespace App\Http\Controllers\Magazzino;

use Illuminate\Http\Request;
use App\Models\Magazzino\Marca;
use App\Http\Controllers\Controller;


class MarcaController extends Controller
{
    public function index(){
        $marche = Marca::with('lotti')->get();
        return view('magazzino.marche.index', [
            'marche' => $marche
        ]);
    }

    public function create(){
        return view('magazzino.marche.create', [
            'nazioniArray' => help_country_iso3166(),
        ]);
    }

    public function store(Request $request){
        
        $this->validation($request);

        $nuovaMarca = new Marca;
        $nuovaMarca->nome = $request['nome'];
        $nuovaMarca->nazioni_selez = $request['nazioni_selez'];
        $nuovaMarca->save();
        return redirect()->route('marche.index')->with('success', 'La marca è stata creata');
    }

    public function edit($marcaId){
        $marca = Marca::find($marcaId);
        return view('magazzino.marche.edit', [
            'marca' => $marca,
            'nazioniArray' => help_country_iso3166(),
        ]);
    }

    public function update(Request $request, $marcaId){

        $marca = Marca::findOrFail($marcaId);

        if($this->updateValidation($request, $marca)){
            $marca->nome = $request['nome'];
            $marca->nazioni_selez = $request['nazioni_selez'];
            $marca->update();
            return redirect()->route('marche.index')->with('success', 'La marca è stata aggiornata');
        }
        return back()->withErrors(['error' => ['Questo nome di marca è già stato utilizzato']]); 
    }

    public function destroy($marcaId){
        Marca::findOrFail($marcaId)->delete();
        return redirect()->route('marche.index')->with('success', 'La marca è stata cancellata');
    }


    protected function validation(Request $request){
        $request->validate([
            'nome' => 'unique:magazzino_marche|required|max:255',
            'nazioni_selez' => 'nullable|json'
        ],
        [
            'nome.unique:magazzino_marche' => 'Questa marca è già stata utilizzata',
            'nome.required' => 'Il campo nome marca è richiesto',
            'nome.max:255' => 'Il nome è troppo lungo',
        ]);
    }

    protected function updateValidation(Request $request, $marca){

        $request->validate([
            'nome' => 'required|max:255',
            'nazioni_selez' => 'nullable|json'
        ],
        [
            'nome.unique:magazzino_marche' => 'Questa marca è già stata utilizzata',
            'nome.required' => 'Il campo nome marca è richiesto',
            'nome.max:255' => 'Il nome è troppo lungo',
        ]);

        $marcaSameName = Marca::where('nome', $request->nome)->first();
        if($marcaSameName){
            if($marcaSameName->id == $marca->id){
                return true; 
            }
            return false;
        }
    }
}
