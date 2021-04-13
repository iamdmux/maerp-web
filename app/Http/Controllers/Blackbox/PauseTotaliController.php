<?php

namespace App\Http\Controllers\Blackbox;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Blackbox\Operatore;
use App\Http\Controllers\Controller;
use App\Models\Blackbox\OperatorePausa;

class PauseTotaliController extends Controller
{
    public function index(Request $request){
        $data = $request->validate([
            'year' => '',
            'month' => ''
        ]);

        $operatori = Operatore::get();
        $operatoriIds = $operatori->pluck('id');
        $operatoriNomeIds = $operatori->pluck('id', 'nome');

        $year = $data['year'] ?? date('Y');
        $month = $data['month'] ?? date('m');

        // scelta option da 2021 in poi
        $yearsArray = [];
        $Ystart = date('Y');
        $Yend = 2021;
        for ($i=$Yend; $i <= $Ystart; $i++) { 
            $yearsArray[] = $i;
        }

        // inizio e fine del mese
        $from = Carbon::createFromFormat('Y-m', "$year-$month")->startOfMonth();
        $to = Carbon::createFromFormat('Y-m', "$year-$month")->endOfMonth();

        $pauseDelMese = OperatorePausa::whereBetween('dalle', [$from, $to])->get();
        $tipiPausa = OperatorePausa::OPERATORI_TIPI_DI_PAUSA;

        // LASCIARE LE ALTRE 'DATE ZERO' DI CARBON come sono ora
        $zeroTime = Carbon::create('first day of January 0000');

        $pauseArray = [];
        foreach ($operatoriIds as $id) {
            foreach ($pauseDelMese as $pausa) {
                if($id == $pausa->operatore_id){

                    // divido i tipi di pause
                    foreach ($tipiPausa as $tipo) {
                        if($pausa->tipo == $tipo){
                            
                            if(!isset($pauseArray[$id][$tipo])){
                                $pauseArray[$id][$tipo] = Carbon::create('first day of January 0000'); // non toccare
                            }

                            $dalle = Carbon::parse($pausa->dalle);
                            $alle = Carbon::parse($pausa->alle);
                            
                            $pauseArray[$id][$tipo]->add($dalle->diff($alle));
                        }
                    }

                    // // pausa totale
                    if(!isset($pauseArray[$pausa->operatore_id]['totale'])){
                        $pauseArray[$pausa->operatore_id]['totale'] = Carbon::create('first day of January 0000'); // non toccare
                    }

                    $pauseArray[$pausa->operatore_id]['totale']->add($dalle->diff($alle));
                }
            }
        }

        // dd($pauseArray);
        return view('blackbox.lavorazioni.pausetotali.index', [
            'operatoriNomeIds' => $operatori,
            'pause' => $pauseArray,
            'year' => $year,
            'month' => $month,
            'mesiArray' => help_mesi_array(),
            'yearsArray' => $yearsArray,
            'zeroTime' => $zeroTime
        ]);
    }
}
