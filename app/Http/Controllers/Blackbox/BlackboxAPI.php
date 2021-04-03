<?php

namespace App\Http\Controllers\Blackbox;

use Illuminate\Http\Request;
use App\Models\Blackbox\Operatore;
use App\Http\Controllers\Controller;
use App\Models\Blackbox\Lavorazione;

class BlackboxAPI extends Controller
{
    public function action($lavorazione_id, Request $request){
        $data = $request->validate([
            'operatore_id' => '',
            'capo_id' => ''
        ]);
        // $lavorazione = Lavorazione::with('capoLavorati')->findOrFail($lavorazione_id);
        
        $operatore = Operatore::find($data['operatore_id']);

        // if($lavoroCapo = $operatore->counterLavorazioni->find($data['capo_id'])){

        // }
        $operatore->lavorazioneCapoCounter()->attach([$data['capo_id']]);
        return true;
    }
}
