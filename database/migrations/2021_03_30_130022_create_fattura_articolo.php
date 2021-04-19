<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFatturaArticolo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fattura_articolo', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('fattura_id')->index();
            $table->unsignedBigInteger('articolo_id')->index();

            $table->foreign('fattura_id')->references('id')->on('fatture')->onDelete('cascade');
            $table->foreign('articolo_id')->references('id')->on('articoli')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fattura_articolo');
    }
}
