<?php

namespace App\Http\Controllers\Acquisti;

use Illuminate\Http\Request;
use App\Models\Acquisti\Fornitore;
use App\Http\Controllers\Controller;

class FornitoreController extends Controller
{
    public function index(){
        $fornitori = Fornitore::orderBy('denominazione')->paginate(100);
        return view('fornitori.index', [
            'fornitori' => $fornitori
        ]);
    }

    public function create(){
        return view('fornitori.show-create-edit', [
            'create' => true,
        ]);
    }

    public function show($fornitoreId){

        $fornitore = fornitore::findOrFail($fornitoreId);
        return view('fornitori.show-create-edit', [
            'show' => true,
            'fornitore' => $fornitore
        ]);
    }

    public function store(Request $request){
        $data = $this->validation($request);
        fornitore::create($data);
        return redirect()->route('fornitori.index')->with('success', 'Un nuovo fornitore è stato creato');
    }

    public function edit($fornitoreId){;
        $fornitore = fornitore::findOrFail($fornitoreId);
        return view('fornitori.show-create-edit', [
            'fornitore' => $fornitore,
            'edit' => true,
        ]);
    }

    public function update(Request $request, $fornitoreId){
        $fornitore = fornitore::findOrFail($fornitoreId);
        $data = $this->validation($request);
        $fornitore->update($data);
        return redirect()->route('fornitori.index')->with('success', 'Il fornitore è stato modificato');
    }

    public function destroy($fornitoreId){
        $fornitore = fornitore::findOrFail($fornitoreId);
        $fornitore->delete();
        return redirect()->route('fornitori.index')->with('success', 'Il fornitore è stato cancellato');
    }

    public function validation(Request $request){
        return $request->validate([
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
            'note_extra' => ''
        ]);
    }
}
