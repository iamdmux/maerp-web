<?php

namespace App\Http\Controllers\Vendite;

use Carbon\Carbon;
use App\Models\Cliente;
use App\Fatturazione\Acube;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Fatturazione\Fatturazione;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\FatturaPostRequest;

class FatturaPdfController extends Controller
{
    public function show(FatturaPostRequest $request, Acube $acube) {
        $cliente = Cliente::findOrFail($request->cliente_id);

        // Fatturazione
        $fattura = new Fatturazione($request);
        $fattura->handle();


        $pdf = PDF::loadView('fatture.fatturapdf', [
            'fattura' => $fattura,
            'cliente' => $cliente
            ]);
        return $pdf->stream();
    }

    public function get(){
        return 'la pagina è visualizzabile solo da -crea fattura-';
    }
}
