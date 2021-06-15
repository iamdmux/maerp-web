<?php

namespace App\Http\Controllers\Vendite;

use Carbon\Carbon;
use App\Fatturazione\Acube;
use Illuminate\Http\Request;
use App\Mail\InvioClientePdf;
use App\Models\Vendite\Cliente;
use App\Models\Vendite\Fattura;
use App\Fatturazione\Fatturazione;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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
            if($val = $articolo->costo_iva_articolo){
                $toMerge['totaleIva'] = ($toMerge['totaleIva']+(float)$val);
            }
            if($val = $articolo->importo_totale_articolo){
                $toMerge['totale'] = ($toMerge['totale']+(float)$val);
            }
        };
        return $toMerge;
    }


    public function inviaPdfFattura(Request $request){
        $request->validate([
            'fattura_id' => 'required'
        ]);

        $fattura = Fattura::with('articoli')->findOrFail($request->fattura_id);
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

        
        //  TEST la modifica è solo in questa pagina
        $TESTEMAIL = Fattura::TEST_INVIA_PDF_A_DESTINATARIO;

        if(!$TESTEMAIL){
            if(!$cliente->email){
                return back()->withErrors(['error' => ['Questo cliente non ha il campo \'email\' ']]); 
            }
        }

        $isElettronica = $fattura->uuid ? true : false;
        $dataIta = $fattura->data_ita;
        $anno = $fattura->data->format('Y');
        $numero = $fattura->numero;

        try {
            //  TEST -> invio a MAIL_FROM_ADDRESS
            if(!$TESTEMAIL){
                $to = $cliente->email;
            } else {
                $to = env('MAIL_FROM_ADDRESS');
            }

            Mail::to($to)
            ->send(new InvioClientePdf($pdf->output(), $fattura->tipo_documento, $isElettronica, $numero, $dataIta, $anno));

            return redirect()->route('fatture.index')->with('success', 'Il documento \'' . $fattura->tipo_documento . '\' è stato inviato correttamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => [$e->getMessage()]]); 
        }
    }

}
