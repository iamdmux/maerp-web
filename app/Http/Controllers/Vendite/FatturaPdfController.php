<?php

namespace App\Http\Controllers\Vendite;

use App\Models\Cliente;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class FatturaPdfController extends Controller
{
    public function show(Request $request) {
        // dd($request->all());
        $data = $request->validate([

        ]);
        $articoliArray = [];

        $totaleImponibile = 0;
        $totaleIva = 0;
        $totale = 0;

        foreach ($request->all() as $field => $val) {
            if(Str::of($field)->startsWith('articolo_id-')){
                $exp = explode("-", $field);
                $articoliArray[$exp[1]]['id'] = $val;
            }
            if(Str::of($field)->startsWith('codice-')){
                $exp = explode("-", $field);
                $articoliArray[$exp[1]]['codice'] = $val;
            }
            if(Str::of($field)->startsWith('quantita-')){
                $exp = explode("-", $field);
                $articoliArray[$exp[1]]['quantita'] = $val;
            }
            if(Str::of($field)->startsWith('unita_di_misura-')){
                $exp = explode("-", $field);
                $articoliArray[$exp[1]]['unita_di_misura'] = $val;
            }
            if(Str::of($field)->startsWith('prezzo_netto-')){
                $exp = explode("-", $field);
                $articoliArray[$exp[1]]['prezzo_netto'] = $val;
            }
            if(Str::of($field)->startsWith('importo_netto-')){
                $exp = explode("-", $field);
                $articoliArray[$exp[1]]['importo_netto'] = $val;
                // tot imponibile
                $totaleImponibile =+ $val;
            }
            if(Str::of($field)->startsWith('descrizione-')){
                $exp = explode("-", $field);
                $articoliArray[$exp[1]]['descrizione'] = $val;
            }
            if(Str::of($field)->startsWith('iva-')){
                $exp = explode("-", $field);
                $articoliArray[$exp[1]]['iva'] = $val;
            }
            if(Str::of($field)->startsWith('costo_iva-')){
                $exp = explode("-", $field);
                $articoliArray[$exp[1]]['costo_iva'] = $val;
                // tot iva
                $totaleIva =+ $val;
            }
            if(Str::of($field)->startsWith('importo_totale-')){
                $exp = explode("-", $field);
                $articoliArray[$exp[1]]['importo_totale'] = $val;
                // totale
                $totale += $val;
            }
        }
        $articoli = collect($articoliArray);
        //IMPORTI TOTALI


        // $articoli['totali']['imponibile'] = 
        // $articoli['totali']['tot_iva'] = 
        // $articoli['totali']['totale'] = 
        
        $cliente = Cliente::findOrFail($request->cliente_id);




        // return view('invoice');
        $pdf = PDF::loadView('fatture.fatturapdf', [
            'cliente' => $cliente,
            'articoli' => $articoli,
            'totaleImponibile' => $totaleImponibile,
            'totaleIva' => $totaleIva,
            'totale' => $totale
            ]
        );
        return $pdf->stream();
    }

    public function get(){
        return ['la pagina è visualizzabile solo da -crea fattura-'];
    }
}
