<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddZeroPercentoIvaToArticoliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articoli', function (Blueprint $table) {
           $table->string('zero_percento_iva')->after('iva')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articoli', function (Blueprint $table) {
            $table->dropColumn('zero_percento_iva');
        });
    }
}
