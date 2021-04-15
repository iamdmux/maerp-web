<?php

namespace App\Http\Controllers\Blackbox;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Blackbox\Operatore;
use App\Http\Controllers\Controller;
use App\Models\Blackbox\Lavorazione;

class BlackboxAPI extends Controller
{
    public function action($lavorazione_id, Request $request){
        $data = $request->validate([
            'operatore_id' => '',
            'capo_pivot_id' => '',
            'aggiungisottrai' => '',
            'init' => ''
        ]);

        if(!isset($data['init'])) {
        $operatore = Operatore::find($data['operatore_id']);
            if($capoLavorato = $operatore->lavorazioneOperatore()->find($data['capo_pivot_id'])){
                $counter = $capoLavorato->pivot->counter;

                if($data['aggiungisottrai'] == 'aggiungi'){
                    $operatore->lavorazioneOperatore()->syncWithoutDetaching([$data['capo_pivot_id'] => ['counter' => ($counter+1)] ]);
                } elseif($data['aggiungisottrai'] == 'sottrai' && $counter > 0){
                    if($counter == 1){
                        $operatore->lavorazioneOperatore()->detach([$data['capo_pivot_id']]);
                    } else {
                        $operatore->lavorazioneOperatore()->syncWithoutDetaching([$data['capo_pivot_id'] => ['counter' => ($counter-1)] ]);
                    }
                }
            } else {
                if($data['aggiungisottrai'] == 'aggiungi'){
                    $operatore->lavorazioneOperatore()->syncWithoutDetaching([$data['capo_pivot_id'] => ['counter' => 1]]);
                }
            }
        }

        $operatori = Operatore::get();
        $counters = $this->getCounters($lavorazione_id);

        $operatoriConCounter = $operatori->merge($counters);
        return $operatoriConCounter;
    }
    

    // spostare la funzione da quanche parte
    protected function getCounters($lavorazione_id){
        return Operatore::with('lavorazioneOperatore')->whereHas('lavorazioneOperatore', function($q) use ($lavorazione_id){
            $q->where('lavorazione_id', $lavorazione_id);
         })->get();
    }

    public function pausa($lavorazione_id, Request $request){

        $data = $request->validate([
            'operatore_id' => '',
            'tipo_pausa' => '',
            'startend' => ''
        ]);

        $lavorazione = Lavorazione::findOrFail($lavorazione_id);
        $tutteLePauseDellOperatore = $lavorazione->pauseLavorazione()->where('operatore_id', $data['operatore_id'])->get();

        if($data['startend'] == 'start'){
            
            $stop = false;
            // se c'è quanche pausa non chiusa
            if($tutteLePauseDellOperatore){
                foreach ($tutteLePauseDellOperatore as $pausa) {
                    if($pausa->pivot->alle == null){
                        $stop = true;
                    }
                }
            }
            if(!$stop){
                $pausa = $lavorazione->pauseLavorazione()->attach([$data['operatore_id'] => ['dalle' => Carbon::now(), 'tipo' => $data['tipo_pausa'] ]]);
            }
            return;
        } elseif($data['startend'] == 'end'){
            if($tutteLePauseDellOperatore->count()){

                $pausa = $lavorazione->pauseLavorazione()
                ->where('operatore_id', $data['operatore_id'])
                ->where('alle', null)
                ->first();

                $pausa->pivot->alle = Carbon::now();
                $pausa->pivot->save();
                // $lavorazione->pauseLavorazione()->syncWithoutDetaching($pausaId, ['alle' => Carbon::now()]);
                // $lavorazione->pauseLavorazione()->syncWithoutDetaching([$data['operatore_id'] => ['alle' => Carbon::now()]]);
            }
            return;
        }

    }

    
    public function getAllPause($lavorazione_id){
        return Lavorazione::findOrFail($lavorazione_id)->pauseLavorazione;
    }
    
}
