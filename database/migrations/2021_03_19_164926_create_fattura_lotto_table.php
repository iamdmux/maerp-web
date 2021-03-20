<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFatturaLottoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fattura_lotto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fattura_id')->index();
            $table->unsignedBigInteger('lotto_id')->nullable()->index();
            $table->string('codice');
            $table->text('nome_prodotto');
            $table->integer('quantita')->default(1);
            $table->string('unita_di_misura');
            $table->integer('prezzo_netto');
            $table->integer('iva');
            $table->integer('sconto')->default(0);
            $table->boolean('non_imponibile')->default(false);
            $table->boolean('applica_ritenute_contributi')->default(false);
            
            $table->foreign('fattura_id')->references('id')->on('fatture')->onDelete('cascade');
            $table->foreign('lotto_id')->references('id')->on('magazzino_lotti')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fattura_lotto');
    }
}
