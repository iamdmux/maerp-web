<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlackboxlavorazioneOperatore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //pause
        Schema::create('blackboxlavorazione_operatore', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lavorazione_id')->index();
            $table->unsignedBigInteger('operatore_id')->index();
            $table->timestamp('dalle');
            $table->timestamp('alle')->nullable();
            $table->string('tipo');

            $table->foreign('lavorazione_id')->references('id')->on('blackbox_operatori')->onDelete('cascade');
            $table->foreign('operatore_id')->references('id')->on('blackbox_operatori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blackboxlavorazione_operatore');
    }
}
