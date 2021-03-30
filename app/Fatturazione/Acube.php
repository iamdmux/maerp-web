<?php
namespace App\Fatturazione;

use Illuminate\Support\Facades\Http;

class Acube {

    protected $user;
    protected $acubeuser;
    protected $acubepass;
    protected $acubeurl;

    public $statusApi;
    public $token;
    public $invoicePostUiid;

    public function __construct($user){
        $this->user = $user;

        $this->acubeuser = env('ACUBEAPI_SANDBOX_USER');
        $this->acubepass = env('ACUBEAPI_SANDBOX_PASSWORD');
        $this->acubeurl = env('ACUBEAPI_SANDBOX_URL');
        $this->login();
    }

    protected function login(){
        if($this->token){
            return true;
        } else {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->acubeurl . '/login_check', [
                "email" => $this->acubeuser,
                "password" => $this->acubepass
            ]);
                
            $this->statusApi = $response->status();

            if($response->successful()){
                $this->token = json_decode($response->body())->token;
                return true;
            }
        }
        return false;
    }

    public function creaFatturaElettronica($request){
        $invoicesimplified = [
            'fattura_elettronica_header' => [
            'dati_trasmissione'=> [
                'codice_destinatario'=> 'ABCDEFG'
            ],
            'cedente_prestatore'=> [
                'id_fiscale_iva'=> [
                    'id_paese'=> 'IT',
                    'id_codice'=> '12345678901'
                ],
                'sede'=> [
                    'indirizzo'=> 'address string',
                    'cap'=> '12345',
                    'comune'=> 'city string',
                    'nazione'=> 'IT'
                ],
                'regime_fiscale'=> 'RF01'
            ],
            'cessionario_committente'=> [
                'identificativi_fiscali'=> [
                    'codice_fiscale'=> 'ABSDVFCNSHBGAFTS'
                ]
            ]
        ],
        'fattura_elettronica_body'=> [[
            'dati_generali'=> [
                'dati_generali_documento'=> [
                    'tipo_documento'=> 'TD07',
                    'divisa'=> 'EUR',
                    'data'=> '2020-07-01',
                    'numero'=> '111'
                ]
            ],
            'dati_beni_servizi'=> [[
                'descrizione'=> 'goods description',
                'importo'=> '100',
                'dati_iva'=> [
                    'imposta'=> '22'
                ]
            ]]
        ]]
        ];
        $invoice = json_encode($invoicesimplified);

        if($this->token){
            $response = Http::withToken($this->token)->post($this->acubeurl . '/invoices/simplified', [
                $invoice
            ]);

            dd($response->body());
        }
        dd('no token');
        if($response->successful()){
            $this->invoicePostUiid = json_decode($response->body())->token;
            return true;
        }
        return false;
    }
}