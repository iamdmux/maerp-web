<?php

namespace App\Http\Controllers\Magazzino;

use Illuminate\Http\Request;
use App\Models\Magazzino\Lotto;
use App\Http\Controllers\Controller;
use App\Models\Magazzino\LottoStatus;

class LottoStatusController extends Controller
{
    public function cambiaStatusLotto($lottoId, Request $request){
        $request->validate([
            'tipo' => 'required'
        ]);

        $lotto = Lotto::with('status')->findOrFail($lottoId);
       
        if(!$request->tipo == 'prenotato' || !$request->tipo == 'venduto'){
            return back()->withErrors(['error' => 'Qualcosa è andato storto. Si prega di riprovare'])->withInput();  
        }


        $prenotatoCount = $lotto->status->filter(function ($item) {
            return $item->pivot->tipo == 'prenotato';
        })->count();

        $vendutoCount = $lotto->status->filter(function ($item) {
            return $item->pivot->tipo == 'venduto';
        })->count();


        // Prenotato
        if($request->tipo == 'prenotato'){
            if($prenotatoCount >= $lotto->quantita){
                return back()->withErrors(['error' => 'Qualcosa è andato storto. Si prega di riprovare'])->withInput();
            } else {
                $lotto->status()->attach(auth()->id(), ['tipo' => $request->tipo]);
            }
        }

        // Venduto
        if($request->tipo == 'venduto'){
            if($vendutoCount >= $lotto->quantita){
                return back()->withErrors(['error' => 'Qualcosa è andato storto. Si prega di riprovare'])->withInput();
            } else {
                $lotto->status()->attach(auth()->id(), ['tipo' => $request->tipo]);
            }
        }

        return back()->with('success', 'il lotto è stato segnalato come ' . $request->tipo);
    }


    public function destroyStatusLotto($pivotId){
        $row = LottoStatus::find($pivotId);

        if($row->user_id == auth()->id() || auth()->user()->hasRole('admin')){
            $row->delete();
            return back()->with('success', 'il valore prenotato/venduto è stato modificato ');
        } else {
            return back()->with('success', 'Qualcosa è andato storto');
        }
    }
}
