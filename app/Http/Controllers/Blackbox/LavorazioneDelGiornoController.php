<?php

namespace App\Http\Controllers\Blackbox;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Blackbox\Operatore;
use App\Http\Controllers\Controller;
use App\Models\Blackbox\Lavorazione;

class LavorazioneDelGiornoController extends Controller
{
    public function show($lavorazione_id){

        $lavorazione = Lavorazione::with('capiScelti')->findOrFail($lavorazione_id);
        $operatori = Operatore::get();

        return view('blackbox.lavorazioni.lavorazione_del_giorno', [
            'lavorazione' => $lavorazione,
            'operatori' => $operatori,
        ]);
    }

    public function indexPause($lavorazione_id){

        $lavorazione = Lavorazione::with('pauseLavorazione')->findOrFail($lavorazione_id);
        $operatoriPause = $lavorazione->pauseLavorazione->groupBy('nome');


        $operatoriTotalePause = [];
        foreach($operatoriPause as $operatore => $pause){
            $totPausa = Carbon::createMidnightDate();
            foreach($pause as $pausa){
                $dalle = Carbon::parse($pausa->pivot->dalle);
                $alle = Carbon::parse($pausa->pivot->alle);
                $totPausa->add($dalle->diff($alle));
            }
            $operatoriTotalePause[$operatore] = ['totPausa' => $totPausa];
        }

        return view('blackbox.lavorazioni.pause.index', [
            'operatoriPause' => $operatoriPause,
            'lavorazioneData' => $lavorazione->dataStrings,
            'operatoriTotalePause'  => $operatoriTotalePause
        ]);
    }
}
