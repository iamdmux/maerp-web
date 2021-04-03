<?php

namespace App\Http\Controllers\Blackbox;

use Illuminate\Http\Request;
use App\Models\Blackbox\Capo;
use App\Http\Controllers\Controller;
use App\Models\Blackbox\Lavorazione;

class LavorazioneController extends Controller
{
    public function index(){
        $lavorazioni = Lavorazione::with('capoLavorati')->paginate(40);
        return view('blackbox.lavorazioni.index', [
            'lavorazioni' => $lavorazioni
        ]);
    }

    public function create(){
        $capiAdulto = Capo::where('tipo', 'adulto')->get(['id', 'nome', 'tipo']);
        $capiBambino =  Capo::where('tipo', 'bambino')->get(['id', 'nome', 'tipo']);

        return view('blackbox.lavorazioni.create', [
            'capiAdulto' => $capiAdulto,
            'capiBambino' => $capiBambino
        ]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'data' => 'required|unique:blackbox_lavorazioni',
            'capo_selezionato_id.*' => 'required'
        ]);

        $lavorazione = new Lavorazione;
        $lavorazione->data = $data['data'];
        $lavorazione->save();
        $lavorazione->capoLavorati()->attach($data['capo_selezionato_id']);
        return redirect()->route('lavorazioni.index')->with('success', 'La lavorazione è stata creata');
    }

    public function edit($id){
        $lavorazione = Lavorazione::findOrFail($id)->with('capoLavorati')->first();
        $capiAdulto = Capo::where('tipo', 'adulto')->get(['id', 'nome', 'tipo']);
        $capiBambino =  Capo::where('tipo', 'bambino')->get(['id', 'nome', 'tipo']);
        return view('blackbox.lavorazioni.edit', [
            'lavorazione' => $lavorazione,
            'capiAdulto' => $capiAdulto,
            'capiBambino' => $capiBambino
        ]);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'data' => 'required|unique:blackbox_lavorazioni,id,:id', // ingora id
            'capo_selezionato_id.*' => 'required'
        ]);

        $lavorazione = Lavorazione::findOrFail($id);
        $lavorazione->data = $data['data'];

        $lavorazione->capoLavorati()->sync($data['capo_selezionato_id']);
        return redirect()->route('lavorazioni.index')->with('success', 'La lavorazione è stata modificata');
    }

    public function destroy($id){
        Lavorazione::findOrFail($id)->delete();
        return redirect()->route('lavorazioni.index')->with('success', 'La lavorazione è stata cancellata');
    }


}
