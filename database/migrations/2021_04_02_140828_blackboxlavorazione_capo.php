<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BlackboxlavorazioneCapo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // lavorazione della giornata
        Schema::create('blackboxlavorazione_capo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lavorazione_id')->index()->nullable();
            $table->unsignedBigInteger('capo_id')->index()->nullable();

            $table->foreign('lavorazione_id')->references('id')->on('blackbox_lavorazioni')->onDelete('cascade');
            $table->foreign('capo_id')->references('id')->on('blackbox_capi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blackboxlavorazione_capo');
    }
}
