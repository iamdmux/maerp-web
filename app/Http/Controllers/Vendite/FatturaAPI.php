<?php

namespace App\Http\Controllers\Vendite;

use App\Models\Vendite\Cliente;
use Illuminate\Http\Request;
use App\Models\Magazzino\Lotto;
use App\Http\Controllers\Controller;
use DragonBe\Vies\Vies;
use DragonBe\Vies\ViesException;
use DragonBe\Vies\ViesServiceException;

class FatturaAPI extends Controller
{
    public function getClienti(Request $request){
        $data = $request->validate([
            'query_cliente' => ''
        ]);

        if (auth()->user()->getRoleNames()[0] == 'agente'){
            return auth()->user()->clienti()
                ->where('clienti.user_id', auth()->id())
                ->where(function ($query) use ($data) {
                    $query->where('denominazione', 'like', '%' . $data['query_cliente'] . '%')
                            ->orWhere('partita_iva', 'like', '%' . $data['query_cliente'] . '%');
                })
                ->limit(10)
                ->get();
        } else {
            return Cliente::where('denominazione', 'like', '%' . $data['query_cliente'] . '%')
            ->orWhere('partita_iva', 'like', '%' . $data['query_cliente'] . '%')
            ->limit(10)
            ->get();
        }
    }

    public function getArticoli(Request $request){
        $data = $request->validate([
            'query_articolo' => ''
        ]);

       return Lotto::where('codice_articolo', 'like', '%' . $data['query_articolo'] . '%')
       ->limit(10)
       ->get();
    }

    public function checkVies($clienteId){
        $cliente = Cliente::find($clienteId);
        if($cliente){

            $vies = new Vies();

            if (false === $vies->getHeartBeat()->isAlive()) {
                return 'Service is not available at the moment, please try again later.';
            }

            $company = [
                'country_code' => $cliente->nazione_sigla,
                'vat_id' => $cliente->partita_iva,
                'trader_name' => $cliente->denominazione,
                'trader_company_type' => '',
                'trader_street' => $cliente->indirizzo,
                'trader_postcode' => $cliente->cap,
                'trader_city' => $cliente->citta,
             ];
             
             try {
                 $vatResult = $vies->validateVat(
                     $company['country_code'],        // Trader country code
                     $company['vat_id'],              // Trader VAT ID
                     'IT',                            // Requester country code (your country code)
                     '11320520015',                    // Requester VAT ID (your VAT ID)
                     $company['trader_name'],         // Trader name
                     $company['trader_company_type'], // Trader company type
                     $company['trader_street'],       // Trader street address
                     $company['trader_postcode'],     // Trader postcode
                     $company['trader_city']          // Trader city
                 );
             } catch (ViesException $viesException) {
                return 'Cannot process VAT validation: ' . $viesException->getMessage();
                exit (2);
             } catch (ViesServiceException $viesServiceException) {
                return 'Cannot process VAT validation: ' . $viesServiceException->getMessage();
                exit (2);
             }

            return 'res: ' . $vatResult->getName()  . ' ' . $vatResult->getCityMatch() . ' ' . $vatResult->getPostcodeMatch() . ' ' .  $vatResult->getCompanyTypeMatch() ;
        }
        
    }
}


/*
aliquota_iva: null
cap: "61-332"
citta: "Poznań"
codice_fiscale: null
codice_sdi: null
denominazione: "\"Amber\" Katarzyna Adamczyk"
fattura_id: null
iban: null
id: 1
indirizzo: "ul. Pawła Strzeleckiego 9"
indirizzo_spedizione: null
metodo_pagamento_predef: null
nazione: "Polonia"
nazione_sigla: "PL"
note_extra: null
note_indirizzo: null
partita_iva: "PL559-179-02-77"
pec: null
provincia: null
referente: null
stock_user_id: null
telefono: null
termini_pagamento: null
termini_tipo: null
*/