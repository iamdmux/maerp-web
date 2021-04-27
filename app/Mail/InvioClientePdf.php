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
        return $this->from('example@example.com')
        ->subject("$tipoDoc num. $anno-$numero del $dataIta")
        ->attachData($this->pdf, "$tipoDoc-$anno-$numero.pdf", [
            'mime' => 'application/pdf',
        ])
        ->markdown('mail.invio-cliente-pdf');
    }
}
