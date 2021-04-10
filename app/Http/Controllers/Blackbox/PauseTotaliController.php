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

        $from = Carbon::createFromFormat('Y-m', "$year-$month")->startOfMonth();
        $to = Carbon::createFromFormat('Y-m', "$year-$month")->endOfMonth();

        $pause = OperatorePausa::whereBetween('dalle', [$from, $to])->get();

        $totPause = [];
        foreach ($operatoriIds as $id) {
            foreach ($pause as $pausa) {
                if($id == $pausa->operatore_id){

                    if(!isset($totPause[$id])){
                        $totPause[$id] = Carbon::createMidnightDate();
                    }

                    $dalle = Carbon::parse($pausa->dalle);
                    $alle = Carbon::parse($pausa->alle);
                    $totPause[$id]->add($dalle->diff($alle));
                }
            }
        }
        
        $yearsArray = [];
        
        $Ystart = date('Y');
        $Yend = 2021;

        for ($i=$Yend; $i <= $Ystart; $i++) { 
            $yearsArray[] = $i;
        }

        // dd($totPause);
        return view('blackbox.lavorazioni.pausetotali.index', [
            'operatoriNomeIds' => $operatori,
            'pause' => $totPause,
            'year' => $year,
            'month' => $month,
            'mesiArray' => help_mesi_array(),
            'yearsArray' => $yearsArray
        ]);
    }
}
