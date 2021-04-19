<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlackboxlavorazionecapoOperatoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // counter lavorazioni
        Schema::create('blackboxlavorazionecapo_operatore', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operatore_id')->index();
            $table->unsignedBigInteger('lavorazionecapo_id')->index();
            $table->integer('counter')->unsigned()->default(0);
            
            $table->foreign('operatore_id')->references('id')->on('blackbox_operatori')->onDelete('cascade');
            $table->foreign('lavorazionecapo_id')->references('id')->on('blackboxlavorazione_capo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blackboxlavorazionecapo_operatore');
    }
}