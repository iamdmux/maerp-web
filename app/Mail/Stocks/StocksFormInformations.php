<?php

namespace App\Mail\Stocks;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StocksFormInformations extends Mailable
{
    use Queueable, SerializesModels;

    public $form;

    public function __construct($formData)
    {
        $this->form = $formData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->form['email'])
                    ->subject($this->form['object'])
                    ->markdown('emails.stocks.formInformations', [
                        'form' => $this->form,
                    ]);
    }
}
