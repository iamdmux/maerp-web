<?php

namespace App\Http\Controllers\Blackbox;

use Illuminate\Http\Request;
use App\Models\Blackbox\Operatore;
use App\Http\Controllers\Controller;
use App\Models\Blackbox\Lavorazione;

class LavorazioneDelGiornoController extends Controller
{
    public function show($lavorazione_id){

        $lavorazione = Lavorazione::with('capoLavorati')->findOrFail($lavorazione_id);
        $operatori = Operatore::get();

        return view('blackbox.lavorazioni.lavorazione_del_giorno', [
            'lavorazione' => $lavorazione,
            'operatori' => $operatori
        ]);
    }
}
