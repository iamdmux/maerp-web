<?php

namespace App\Http\Controllers\Blackbox;

use Illuminate\Http\Request;
use App\Models\Blackbox\Capo;
use App\Models\Blackbox\Operatore;
use App\Http\Controllers\Controller;
use App\Models\Blackbox\Lavorazione;

class LavorazioneController extends Controller
{
    public function index(){
        $lavorazioni = Lavorazione::with('capiScelti', 'operatori')->orderBy('data', 'desc')->paginate(40);
        return view('blackbox.lavorazioni.index', [
            'lavorazioni' => $lavorazioni
        ]);
    }

    public function create(){
        $capiAdulto = Capo::where('tipo', 'adulto')->get(['id', 'nome', 'tipo']);
        $capiBambino =  Capo::where('tipo', 'bambino')->get(['id', 'nome', 'tipo']);
        $operatori = Operatore::get();

        return view('blackbox.lavorazioni.create', [
            'capiAdulto' => $capiAdulto,
            'capiBambino' => $capiBambino,
            'operatori' => $operatori
        ]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'data' => 'required',
            'nome' => 'required',
            'capo_selezionato_id.*' => 'required',
            'operatore_selezionato_id.*' => 'required',
        ]);

        if(!isset($data['capo_selezionato_id'])){
            return back()->withErrors(['error' => ['il campo -capo- non può essere vuoto']]);       
        }
        if(!isset($data['operatore_selezionato_id'])){
            return back()->withErrors(['error' => ['il campo -operatore- non può essere vuoto']]);       
        }

        $lavorazione = new Lavorazione;
        $lavorazione->nome = $data['nome'];
        $lavorazione->data = $data['data'];
        $lavorazione->save();

        $lavorazione->capiScelti()->attach($data['capo_selezionato_id']);
        $lavorazione->operatori()->attach($data['operatore_selezionato_id']);

        return redirect()->route('lavorazioni.index')->with('success', 'La lavorazione è stata creata');
    }

    public function edit($id){
        
        $lavorazione = Lavorazione::with('capiScelti', 'operatori')->findOrFail($id);
        $capiAdulto = Capo::where('tipo', 'adulto')->get(['id', 'nome', 'tipo']);
        $capiBambino =  Capo::where('tipo', 'bambino')->get(['id', 'nome', 'tipo']);
        $operatori = Operatore::get();

        return view('blackbox.lavorazioni.edit', [
            'lavorazione' => $lavorazione,
            'capiAdulto' => $capiAdulto,
            'capiBambino' => $capiBambino,
            'operatori' => $operatori
        ]);
    }

    public function update(Request $request, $id){

        $data = $request->validate([
            'data' => 'required',
            'nome' => 'required',
            'capo_selezionato_id.*' => 'required',
            'operatore_selezionato_id.*' => 'required',
        ]);

        if(!isset($data['capo_selezionato_id'])){
            return back()->withErrors(['error' => ['il campo -capo- non può essere vuoto']]);       
        }
        if(!isset($data['operatore_selezionato_id'])){
            return back()->withErrors(['error' => ['il campo -operatore- non può essere vuoto']]);       
        }

        $lavorazione = Lavorazione::findOrFail($id);
        $lavorazione->data = $data['data'];
        $lavorazione->nome = $data['nome'];

        if($lavorazione->update()){
            $lavorazione->capiScelti()->sync($data['capo_selezionato_id']);
            $lavorazione->operatori()->sync($data['operatore_selezionato_id']);
        }

        return redirect()->route('lavorazioni.index')->with('success', 'La lavorazione è stata modificata');
    }

    public function destroy($id){
        Lavorazione::findOrFail($id)->delete();
        return redirect()->route('lavorazioni.index')->with('success', 'La lavorazione è stata cancellata');
    }


}
