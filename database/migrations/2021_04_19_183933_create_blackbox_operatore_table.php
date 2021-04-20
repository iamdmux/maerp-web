<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlackboxOperatoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blackbox_lavorazione_operatore', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operatore_id')->index();
            $table->unsignedBigInteger('lavorazione_id')->index();

            $table->foreign('operatore_id')->references('id')->on('blackbox_operatori')->onDelete('cascade');
            $table->foreign('lavorazione_id')->references('id')->on('blackbox_lavorazioni')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blackbox_lavorazione_operatore');
    }
}
