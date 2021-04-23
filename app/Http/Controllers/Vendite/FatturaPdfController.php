<?php

namespace App\Http\Controllers\Vendite;

use Carbon\Carbon;
use App\Fatturazione\Acube;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Vendite\Cliente;
use App\Models\Vendite\Fattura;
use App\Fatturazione\Fatturazione;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\FatturaPostRequest;

class FatturaPdfController extends Controller
{
    public function post(FatturaPostRequest $request) {
        $cliente = Cliente::findOrFail($request->cliente_id);

        // Fatturazione
        $fatturazione = new Fatturazione($request);
        $fatturazione->handle();

        PDF::setOptions(['defaultFont' => 'serif']);
        $pdf = PDF::loadView('fatture.fatturapdf', [
            'fattura' => $fatturazione,
            'cliente' => $cliente
            ]);
        return $pdf->stream();
    }

    public function get(){
        return 'la pagina è visualizzabile solo da -crea fattura-';
    }

    public function show($fatturaId){
        $fattura = Fattura::with('articoli')->findOrFail($fatturaId);
        $cliente = Cliente::findOrFail($fattura->cliente_id);
        $totali = $this->getTotaliForShow($fattura);

        $fattura->totaleImponibile = $totali['totaleImponibile'];
        $fattura->totaleIva = $totali['totaleIva'];
        $fattura->totale = $totali['totale'];

        PDF::setOptions(['defaultFont' => 'serif']);
        $pdf = PDF::loadView('fatture.fatturapdf', [
            'fattura' => $fattura,
            'cliente' => $cliente
            ]);
        return $pdf->stream();
    }


    public function getTotaliForShow($fattura){
        $toMerge = ['totaleImponibile' => 0.00, 'totaleIva' => 0.00, 'totale' => 0.00];

        foreach ($fattura->articoli as $articolo) {
            if($val = $articolo->importo_netto){
                $toMerge['totaleImponibile'] = ($toMerge['totaleImponibile']+(float)$val);
            }
            if($val = $articolo->costo_iva){
                $toMerge['totaleIva'] = ($toMerge['totaleIva']+(float)$val);
            }
            if($val = $articolo->importo_totale){
                $toMerge['totale'] = ($toMerge['totale']+(float)$val);
            }
        };
        return $toMerge;
    }

}
