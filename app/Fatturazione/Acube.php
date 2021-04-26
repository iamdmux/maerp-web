<?php
namespace App\Fatturazione;


use App\Fatturazione\FatturaArray;
use Illuminate\Support\Facades\Http;

class Acube extends FatturaArray{

    protected $user;
    protected $acubeuser;
    protected $acubepass;
    protected $acubeurl;

    public $statusApi;
    public $token;
    public $invoicePostUiid;

    public $error;

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

    public function creaFatturaElettronica($fatturazione){
        if($this->login()){
            $response = Http::withToken($this->token)->post($this->acubeurl . '/invoices', $this->compilaFattura($fatturazione));
        }

        if($response->successful()){
            $this->invoicePostUiid = $response->json()['uuid'];
            return true;
        } else {
            //$response->getBody()->getContents();
            if($error = collect(json_decode($response->body()))['hydra:description']){
                $this->error = $error;
                $this->error .= ' C\'è stato un errore e la fatturazione elettronica NON è stata creata.';
            } else {
                $this->error = ' C\'è stato un errore e la fatturazione elettronica NON è stata creata.';
            }
            return false;
        }
        return false;
    }
}