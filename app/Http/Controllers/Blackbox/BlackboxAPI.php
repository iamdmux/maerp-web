<?php

namespace App\Http\Controllers\Blackbox;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Blackbox\Operatore;
use App\Http\Controllers\Controller;
use App\Models\Blackbox\Lavorazione;
use App\Models\Blackbox\OperatorePausa;

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

    public function creaPausa($lavorazione_id, Request $request){

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

                // PATCH PER PRODUCT
                $pausaBefore = $lavorazione->pauseLavorazione()
                ->where('operatore_id', $data['operatore_id'])
                ->where('alle', null)
                ->first();

                $pausa = OperatorePausa::findOrFail($pausaBefore->pivot->id);
                $pausa->dalle = $pausaBefore->pivot->dalle;
                $pausa->alle = Carbon::now();
                $pausa->update();

                // $lavorazione->pauseLavorazione()->updateExistingPivot($data['operatore_id'], ['alle' => Carbon::now()]);
                // $lavorazione->pauseLavorazione()->syncWithoutDetaching([$data['operatore_id'] => ['alle' => Carbon::now()]]);
            }
            return;
        }

    }

    public function getAllPause($lavorazione_id){
        return Lavorazione::findOrFail($lavorazione_id)->pauseLavorazione;
    }



    // MODIFICHE PAUSE
    public function modificaPause($lavorazioneId, Request $request){
        $request->validate([
            'id' => '',
            'datirimozione' => '',
            'nuovepause' => '',
            'password' => ''
        ]);

        $rimozioniArray = json_decode($request->datirimozione, true);
        $aggiungiPauseArray = json_decode($request->nuovepause, true);
        //$lavorazione = Lavorazione::findOrFail($lavorazioneId);

        if($request->password != 'attento'){
            return response()->json(['error' => 'la password non è corretta'], 422);
        }

        // rimozione
        foreach ($rimozioniArray as $operatoreId => $pause) {
            if($pause){
                foreach ($pause as $pausaId => $bool) {
                    if($pausarow = OperatorePausa::find($pausaId)){
                        $pausarow->delete();
                    } else {
                        return response()->json(['error' => 'qualcosa è andato storto'], 422);
                    }
                }
            }
        }

        // aggiungi pausa
        $lavorazione = Lavorazione::findOrFail($lavorazioneId);

        foreach ($aggiungiPauseArray as $opId => $pausa) {
            if($pausa && isset($pausa['dalle'])){
                $dalle = Carbon::parse($pausa['dalle']);
                $alle = Carbon::parse($pausa['alle']);
                if($dalle < $alle){
                    $lavorazione->pauseLavorazione()->attach([$opId => ['dalle' => $dalle, 'alle' => $alle, 'tipo' => $pausa['tipo'] ]]);
                }
            }
        }
    }
    
}
