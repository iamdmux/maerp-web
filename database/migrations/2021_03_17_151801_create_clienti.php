<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clienti', function (Blueprint $table) {
            $table->id();
            $table->string('denominazione');
            $table->string('codice_sdi')->nullable();
            $table->string('tipologia')->nullable();
            $table->string('referente')->nullable();
            $table->string('partita_iva')->nullable();
            $table->string('paese')->nullable();
            $table->string('indirizzo')->nullable();
            $table->string('citta')->nullable();
            $table->string('cap')->nullable();
            $table->string('provincia')->nullable();
            $table->text('note_indirizzo')->nullable();
            $table->string('codice_interno')->nullable();
            $table->string('email')->nullable();
            $table->string('pec')->nullable();
            $table->string('telefono')->nullable();
            $table->text('note_extra')->nullable();
            $table->string('aliquota_iva')->nullable();
            $table->string('termini_pagamento')->nullable();
            $table->string('termini_tipo')->nullable();
            $table->string('metodo_pagamento_predef')->nullable();
            $table->string('iban')->nullable();
            $table->string('fax')->nullable();
            $table->text('indirizzo_spedizione')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clienti');
    }
}
