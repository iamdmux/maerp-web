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
            $table->unsignedBigInteger('user_id')->nullable()->index(); // agente_id
            $table->boolean('is_fattura_elettronica')->defalut(false);
            $table->timestamp('saldata_il')->nullable();
            // dati documento
            $table->timestamp('data');
            $table->integer('numero');
            $table->string('lingua')->default('it');
            $table->string('valuta')->default('eur');
            $table->text('oggetto_visibile')->nullable();
            $table->text('oggetto_interno')->nullable();
            $table->text('centro_di_ricavo')->nullable();
            // contributi e ritenute
            $table->boolean('applica_rivalsa')->default(false);
            $table->integer('rivalsa_inps')->nullable();
            $table->integer('rit_dacconto')->nullable();
            $table->boolean('applica_ritenuta')->default(false);
            $table->integer('cassa_prof')->nullable();
            $table->integer('imponibile_ritenuta')->nullable();
            $table->boolean('applica_altra_ritenuta')->default(false);
            $table->integer('altra_ritenuta')->nullable();
            $table->timestamps();
            //opzioni_avanzate
            $table->string('metodo_pagamento')->nullable();
            $table->boolean('mostra_dettagli_pagamento')->default(false);
            $table->boolean('documento_di_trasporto')->default(false);
            $table->boolean('fatt_accompagnatoria')->default(false);
            $table->boolean('includi_marca_da_bollo')->default(false);
            $table->integer('costo_bollo')->nullable();
            $table->boolean('applica_sconto_o_maggiorazione_sul_tot')->default(false);
            $table->text('tipo_sconto_o_maggiorazione_sul_tot')->nullable();
            $table->integer('val_sconto_o_maggiorazione_sul_tot')->nullable();
            $table->integer('sconto')->nullable();
            $table->integer('maggiorazione')->nullable();
            $table->boolean('applica_split_payment')->default(false);
            // doc trasporto / accompagnatoria
            $table->string('modello_grafico_ddt')->nullable();
            $table->string('modello_grafico_fatt_accomp')->nullable();
            $table->integer('numero_ddt')->nullable();
            $table->timestamp('data_ddt')->nullable();
            $table->integer('colli')->nullable();
            $table->integer('peso')->nullable();
            $table->text('casuale_trasporto')->nullable();
            $table->text('luogo_destinazione')->nullable();
            $table->string('trasporto_a_cura_di')->nullable();
            $table->text('annotazioni')->nullable();
            // personalizzazione
            $table->boolean('mostra_scadenze')->default(false);
            $table->boolean('mostra_notifica_pagamento_effettuato')->default(false);

            //termini pagamento, ora qui (in fattureincloud possono essere dei multipli)
            $table->string('termini_pagamento')->default('30gg');
            $table->timestamp('scadenza');
            $table->string('stato')->default('non-saldato');

            $table->text('note_documento')->nullable();
            $table->boolean('usa_prezzi_lordi')->nullable();

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
