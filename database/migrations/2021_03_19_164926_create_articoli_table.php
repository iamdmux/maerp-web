<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticoliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articoli', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('fattura_id')->index();
            $table->unsignedBigInteger('lotto_id')->nullable()->index();
            $table->string('codice');
            $table->integer('quantita')->default(1);
            $table->string('unita_di_misura')->nullable();
            $table->text('descrizione')->nullable();

            $table->float('prezzo_netto');
            $table->float('iva');
            $table->float('importo_netto');
            $table->float('costo_iva_articolo');
            $table->float('importo_totale_articolo');
            $table->timestamps();

            // $table->foreign('fattura_id')->references('id')->on('fatture')->onDelete('cascade');
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
