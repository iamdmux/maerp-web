<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksItemsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks_items_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('lotto_id')->index();
            $table->integer('quantita')->unsigned();

            $table->foreign('order_id')->references('id')->on('stocks_orders')->onDelete('cascade');
            $table->foreign('lotto_id')->references('id')->on('magazzino_lotti')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks_items_orders');
    }
}
