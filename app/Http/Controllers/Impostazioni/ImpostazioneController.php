<?php

namespace App\Http\Controllers\Impostazioni;

use App\Models\Impostazione;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImpostazioneController extends Controller
{
    public function edit(){
        $impostazioni = Impostazione::find(1);
        return view('impostazioni.edit', [
            'impostazioni' => $impostazioni
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'numerazione_fattura' => 'required|integer'
        ]);
        $impostazioni = Impostazione::find(1);
        $impostazioni->numerazione_fattura = $request->numerazione_fattura;
        $impostazioni->update();
        return redirect()->route('home.page')->with('success', 'Impostazioni modificate');
    }
}
