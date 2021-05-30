<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFattureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fatture', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index(); // agente_id
            $table->string('tipo_documento');
            $table->boolean('fattura_elettronica')->default(false);
            $table->boolean('is_from_stocks')->default(false);
            $table->uuid('uuid')->nullable(); // acube uuid
            $table->integer('numero')->unsigned();
            $table->timestamp('data');
            $table->string('lingua');
            $table->string('valuta');
            $table->text('note_documento')->nullable();

            $table->string('el_codice_destinatario')->nullable();
            $table->string('el_indirizzo_pec')->nullable();
            $table->string('el_esigibilita_iva')->nullable();
            $table->string('el_emesso_in_seguito_a')->nullable();
            $table->string('el_metodo_pagamento')->nullable();;
            $table->string('el_nome_istituto_di_credito')->nullable();
            $table->string('el_iban')->nullable();
            $table->string('el_nome_beneficiario')->nullable();
            
            $table->boolean('documento_di_trasporto')->default(false);
            $table->boolean('includi_marca_da_bollo')->default(false);
            $table->string('costo_bollo')->nullable();
            $table->string('includi_metodo_pagamento')->default(false);
            $table->string('metodo_pagamento')->nullable();
            $table->boolean('includi_note_pagamento')->default(false);
            $table->text('note_pagamento')->nullable();

            $table->string('numero_ddt')->nullable();
            $table->timestamp('data_ddt')->nullable();
            $table->integer('numero_colli_ddt')->unsigned()->nullable();
            $table->string('peso_ddt')->nullable();
            $table->text('casuale_trasporto')->nullable();
            $table->text('trasporto_a_cura_di')->nullable();
            $table->text('luogo_destinazione')->nullable();
            $table->text('annotazioni')->nullable();
            $table->float('importo_totale');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clienti')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fatture');
    }
}
