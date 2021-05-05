<?php

namespace App\Http\Controllers\Magazzino;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Magazzino\Lotto;
use App\Models\Magazzino\Marca;
use App\Http\Controllers\Controller;

class LottoController extends Controller
{
    public function __construct(){
        $this->middleware(['permission:visualizzare-lotti'])->only('index');
        // $this->middleware(['permission:modificare-lotti'])->except('index');
    }

    public function index(){

        $lotti = Lotto::with('marca', 'status')->orderBy('created_at', 'DESC')->get();

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
        $lotto = Lotto::with('marca', 'status')->findOrFail($lottoId);
        $tipoogia = Lotto::TIPOLOGIA;
        $marche = Marca::get();

        $prenotatoList = $lotto->status->filter(function ($item) {
            return $item->pivot->tipo == 'prenotato';
        });

        $vendutoList = $lotto->status->filter(function ($item) {
            return $item->pivot->tipo == 'venduto';
        });


        return view('magazzino.lotti.edit', [
            'lotto' => $lotto,
            'tipoogia' => $tipoogia,
            'marche' => $marche,
            'prenotatoList' => $prenotatoList,
            'vendutoList' => $vendutoList
        ]);
    }

    public function update(Request $request, $lottoId){
        $data = $this->validation($request);

        $lotto = Lotto::findOrFail($lottoId);

        if(auth()->user()->can('modificare-lotti')){
            $lotto->update($data->all());
            return redirect()->route('lotti.index')->with('success', 'Il lotto è stato aggiornato');
        } else {
            return redirect()->route('lotti.index')->with('success', 'Qualcosa è andato storto');
        }
        
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
            'codice_articolo' => 'required'
        ]);
        return $request;
    }

}
