<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvioClientePdf extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $tipoDoc;
    public $isElettronica;
    public $numero;
    public $dataIta;
    public $anno;


    public function __construct($pdf, $tipoDoc, $isElettronica, $numero, $dataIta, $anno)
    {
        $this->pdf = $pdf;
        $this->tipoDoc = $tipoDoc;
        $this->isElettronica = $isElettronica;
        $this->numero = $numero;
        $this->dataIta = $dataIta;
        $this->anno = $anno;

    }
    public function build()
    {   
        return $this->from(env('MAIL_FROM_ADDRESS'))
        ->subject("$this->tipoDoc num. $this->anno-$this->numero del $this->dataIta")
        ->attachData($this->pdf, "$this->tipoDoc-$this->anno-$this->numero.pdf", [
            'mime' => 'application/pdf',
        ])
        ->markdown('mail.invio-cliente-pdf');
    }
}
