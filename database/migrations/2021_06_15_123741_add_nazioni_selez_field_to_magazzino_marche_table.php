<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNazioniSelezFieldToMagazzinoMarcheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('magazzino_marche', function (Blueprint $table) {
            $table->text('nazioni_selez')->after('nome')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('magazzino_marche', function (Blueprint $table) {
            $table->dropColumn('nazioni_selez');
        });
    }
}
