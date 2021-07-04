<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks_forms', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_form');
            $table->unsignedBiginteger('user_id')->nullable();
            $table->string('nome');
            $table->string('cognome');
            $table->string('email');
            $table->string('azienda')->nullable();
            $table->string('oggetto');
            $table->text('messaggio');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks_forms');
    }
}
