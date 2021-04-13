<?php

namespace App\Http\Controllers\Blackbox;

use Illuminate\Http\Request;
use App\Models\Blackbox\Operatore;
use App\Http\Controllers\Controller;
use App\Models\Blackbox\OperatoreFerie;

class FerieController extends Controller
{
    public function index(){
        $ferieAnno = OperatoreFerie::with('operatore')->get();
        return view('blackbox.ferie.index', [
            'ferieAnno' => $ferieAnno
        ]);
    }

    public function create(){
        $operatori = Operatore::get();
        return view('blackbox.ferie.create', [
            'operatori' => $operatori
        ]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'operatore_id' => '',
            'dal' => '',
            'al' => '',
            'note' => 'nullable|max:65535'
        ]);
        $operatore = Operatore::findOrFail($data['operatore_id']);
        $ferie = OperatoreFerie::create($data);

        return redirect()->route('ferie.index')->with('success', 'Le ferie sono state aggiunte');
    }

    public function edit($ferieId){
        $operatori = Operatore::get();
        $ferie = OperatoreFerie::findOrFail($ferieId);
        return view('blackbox.ferie.edit', [
            'ferie' => $ferie,
            'operatori' => $operatori
        ]);
    }

    public function update(Request $request, $ferie_id){
        $data = $request->validate([
            'operatore_id' => '',
            'dal' => '',
            'al' => '',
            'note' => 'nullable|max:65535'
        ]);
        $operatore = Operatore::findOrFail($data['operatore_id']);
        $ferie = OperatoreFerie::findOrFail($ferie_id);
        $ferie->update($data);

        return redirect()->route('ferie.index')->with('success', 'Le ferie sono state modificate');
    }

    public function destroy($ferie_id){
        $ferie = OperatoreFerie::findOrFail($ferie_id);
        $ferie->delete();
        return redirect()->route('ferie.index')->with('success', 'Le ferie sono state cancellate');
    }
}
