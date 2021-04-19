<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagazzinoLotti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazzino_lotti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marca_id')->index()->nullable();
            $table->string('stagione');
            $table->string('tipologia');
            $table->integer('quantita');
            $table->timestamp('prenotato')->nullable();
            $table->timestamp('venduto')->nullable();
            $table->string('venditore'); // sarà agente Id
            $table->integer('kg')->nullable();
            $table->string('codice_articolo')->nullable();
            $table->timestamps();

            $table->foreign('marca_id')->references('id')->on('magazzino_marche')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magazzino_lotti');
    }
}
