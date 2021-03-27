<?php

namespace App\Http\Controllers\Vendite;

use Carbon\Carbon;
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
        $totaleImponibile = 0.00;
        $totaleIva = 0.00;
        $totale = 0.00;


        $i = 0;
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
                $totaleImponibile = ($totaleImponibile + $val);
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
                $totaleIva = ($totaleIva + $val);
            }
            if(Str::of($field)->startsWith('importo_totale-')){
                $exp = explode("-", $field);
                $articoliArray[$exp[1]]['importo_totale'] = $val;
                // totale
                $totale = $totale+$val;
            }
            $i++;
        }

        //bollo
        if($request->includi_marca_da_bollo){
            if(is_numeric($bol = str_replace(',', '.', $request->costo_bollo))){
                $totale = ($totale+$bol);
            }
        }

        $articoli = collect($articoliArray);
        $cliente = Cliente::findOrFail($request->cliente_id);

        // TEST HTTP
        // $acubeuser = env('ACUBEAPI_SANDBOX_USER');
        // $acubepass = env('ACUBEAPI_SANDBOX_PASSWORD');
        // $acubeurl = env('ACUBEAPI_SANDBOX_URL');


        
        // return view('invoice');
        $pdf = PDF::loadView('fatture.fatturapdf', [

            'tipo_documento' => $request->tipo_documento,

            'cliente' => $cliente,
            'articoli' => $articoli,
            'totaleImponibile' => $totaleImponibile,
            'totaleIva' => $totaleIva,
            'totale' => $totale,
            'note_documento' => $request->note_documento,

            // metodo pagamento
            'includi_metodo_pagamento' => $request->includi_metodo_pagamento,
            'metodo_pagamento' => $request->metodo_pagamento,

            // //bollo
            'includi_marca_da_bollo' => $request->includi_marca_da_bollo,
            'costo_bollo' => $request->costo_bollo,

            // date
            'numero' => $request->numero,
            'data' => $request->data ? Carbon::createFromFormat('Y-m-d', $request->data)->format('d-m-Y') : null,
            'data_ddt' => $request->data_ddt ? Carbon::createFromFormat('Y-m-d', $request->data_ddt)->format('d-m-Y') : null,

            // DDT
            'documento_di_trasporto' => $request->documento_di_trasporto,
            'numero_ddt' => $request->numero_ddt,
            'data_ddt' => $request->data_ddt,
            'casuale_trasporto' => $request->casuale_trasporto,
            'luogo_destinazione' => $request->luogo_destinazione,
            'trasporto_a_cura_di' => $request->trasporto_a_cura_di,
            'peso_ddt' => $request->peso_ddt,
            'numero_colli_ddt' => $request->numero_colli_ddt,
            'annotazioni' => $request->annotazioni,
            ]
        );
        return $pdf->stream();
    }

    public function get(){
        return 'la pagina è visualizzabile solo da -crea fattura-';
    }
}
