<?php

namespace App\Http\Controllers\Vendite;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class FatturaPdfController extends Controller
{
    public function show(Request $request) {
        // dd($request->all());
        $data = $request->validate([

        ]);

        $cliente = Cliente::findOrFail($request->ragione_sociale);
   
        
        // return view('invoice');
        $pdf = PDF::loadView('fatture.fatturapdf', [
            'cliente' => $cliente ]
        );
        return $pdf->stream();
    }

    public function get(){
        return ['la pagina è visualizzabile solo da -crea fattura-'];
    }
}
