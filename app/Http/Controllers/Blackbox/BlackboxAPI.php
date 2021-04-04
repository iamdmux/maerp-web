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
            'capo_pivot_id' => ''
        ]);

        $operatore = Operatore::find($data['operatore_id']);

        if($capoLavorato = $operatore->lavorazioneOperatore()->find($data['capo_pivot_id'])){
            $counter = $capoLavorato->pivot->counter;
            $operatore->lavorazioneOperatore()->syncWithoutDetaching([$data['capo_pivot_id'] => ['counter' => ($counter+1)] ]);
        } else {
            $operatore->lavorazioneOperatore()->syncWithoutDetaching([$data['capo_pivot_id'] => ['counter' => 1]]);
        }
        
        $operatori = Operatore::get();
        $counters = $this->getCounters($lavorazione_id);

        $operatoriConCounter = $operatori->merge($counters);
        return $operatoriConCounter;
    }

    // spostare la funzione da quanche parte
    public function getCounters($lavorazione_id){
        return Operatore::with('lavorazioneOperatore')->whereHas('lavorazioneOperatore', function($q) use ($lavorazione_id){
            $q->where('lavorazione_id', $lavorazione_id);
         })->get();
    }
    
}
