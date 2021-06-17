<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFatturaIdToArticoliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('articoli', function (Blueprint $table) {
        //     $table->unsignedBigInteger('fattura_id')->after('lotto_id')->nullable()->index();

        //     $table->foreign('fattura_id')->references('id')->on('fatture')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articoli', function (Blueprint $table) {
            // $table->dropColumn('fattura_id');
        });
    }
}
