<?php

namespace App\Http\Controllers\Magazzino;

use Illuminate\Http\Request;
use App\Models\Magazzino\Lotto;
use App\Models\Magazzino\Marca;
use App\Http\Controllers\Controller;

class LottoController extends Controller
{
    public function index(){
        $lotti = Lotto::with('marca')->get();

        return view('magazzino.lotti.index', [
            'lotti' => $lotti,
        ]);
    }

    public function create(){
        $tipoogia = Lotto::TIPOLOGIA;
        $marche = Marca::get();
        return view('magazzino.lotti.create', [
            'tipoogia' => $tipoogia,
            'marche' => $marche
        ]);
    }

    public function store(Request $request){
        
        $data = $this->validation($request);

        $nuovLotto = new Lotto;
        $nuovLotto->create($data->all());

        return redirect()->route('lotti.index')->with('success', 'Il lotto è stata creato');
    }

    public function edit($lottoId){
        $lotto = Lotto::findOrFail($lottoId);
        $tipoogia = Lotto::TIPOLOGIA;
        $marche = Marca::get();
        return view('magazzino.lotti.edit', [
            'lotto' => $lotto,
            'tipoogia' => $tipoogia,
            'marche' => $marche
        ]);
    }

    public function update(Request $request, $lottoId){
        $data = $this->validation($request);

        $lotto = Lotto::findOrFail($lottoId);
        $lotto->update($data->all());
        return redirect()->route('lotti.index')->with('success', 'Il lotto è stato aggiornato');
    }

    public function destroy($lottoId){
        Lotto::findOrFail($lottoId)->delete();
        return redirect()->route('lotti.index')->with('success', 'Il lotto è stata cancellato');
    }



    protected function validation(Request $request){

        $request->validate([
            'marca_id' => 'required|exists:magazzino_marche,id',
            'stagione' => 'required',
            'tipologia' => 'required',
            'kg' => 'required|numeric',
            'quantita' => 'required|numeric',
            'venditore' => 'required',
            'codice_articolo' => 'required'
        ]);
        return $request;
    }

    // public function messages(){
    //     return  [
    //         'marca_id:required' => 'il valore -marca- è richesto',
    //         'marca_id:exists:magazzino_marche,id' => 'Qualcosa è andato storto con la marca'
    //     ];
    // }
}
