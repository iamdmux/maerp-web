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


    /**
     * Check a given VAT number with the europe VIES check
    *
    * @param string $country The country code to check with the VAT number.
    * @param string $vat_nr The VAT number to check.
    *
    * @return bool|null
    */
    public function check_vat($clienteId) //$country, $vat_nr
    {

        $cliente = Cliente::find($clienteId);
            if($cliente){

                $country = $cliente->nazione_sigla;
                $vat_nr = $cliente->partita_iva;

                // Strip all spaces from the VAT number to improve usability of the VAT field.
                $vat_nr = str_replace(' ', '', $vat_nr);
                if (0 === strpos($vat_nr, $country)) {
                    $vat_nr = trim(substr($vat_nr, strlen($country)));
                }
                try {
                    // Do the remote request.
                    $client = new \SoapClient('http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl');
                    $returnVat = $client->checkVat(array('countryCode' => $country, 'vatNumber' => $vat_nr));
                } catch (\Exception $e) {
                    error_log('VIES API Error for ' . $country . ' - ' . $vat_nr . ': ' . $e->getMessage());
                    return 3;
                }
                // Return the response.
                if (isset($returnVat)) {
                    if (true == $returnVat->valid) {
                        return 1;
                    } else {
                        return 0;
                    }
                }
                // Return null if the service is down.
                return 2;
            }
        }
    }