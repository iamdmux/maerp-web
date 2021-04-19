<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFatturaidToClienti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clienti', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->unsignedBigInteger('fattura_id')->after('id')->nullable()->index();

            $table->foreign('fattura_id')->references('id')->on('fatture')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clienti', function (Blueprint $table) {
            $table->dropColumn('fattura_id');
        });
    }
}
