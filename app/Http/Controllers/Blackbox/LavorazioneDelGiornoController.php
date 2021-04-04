<?php

namespace App\Http\Controllers\Blackbox;

use Illuminate\Http\Request;
use App\Models\Blackbox\Operatore;
use App\Http\Controllers\Controller;
use App\Models\Blackbox\Lavorazione;

class LavorazioneDelGiornoController extends Controller
{
    public function show($lavorazione_id){

        $lavorazione = Lavorazione::with('capiScelti')->findOrFail($lavorazione_id);
        $operatori = Operatore::get();
        $counters = $this->getCounters($lavorazione_id);

        $operatoriConCounter = $operatori->merge($counters);

        return view('blackbox.lavorazioni.lavorazione_del_giorno', [
            'lavorazione' => $lavorazione,
            'operatori' => $operatoriConCounter,
        ]);
    }

    public function getCounters($lavorazione_id){
        return Operatore::with('lavorazioneOperatore')->whereHas('lavorazioneOperatore', function($q) use ($lavorazione_id){
            $q->where('lavorazione_id', $lavorazione_id);
         })->get();
    }
}
