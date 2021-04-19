<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatoreferieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blackbox_operatoreferie', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('operatore_id')->index();
            $table->timestamp('dal')->nullable(); // nullable => fix error
            $table->timestamp('al')->nullable(); // fnullable => fix error
            $table->text('note')->nullable();

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
        Schema::dropIfExists('blackbox_operatoreferie');
    }
}
