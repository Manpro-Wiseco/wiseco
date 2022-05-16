<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemAdjustmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_adjustment', function (Blueprint $table) {
            $table->id();
            $table->foreign('item_id')->references('id')->on('items');
            $table->unsignedBigInteger('item_id');
            $table->foreign('adjustment_id')->references('id')->on('adjustments');
            $table->unsignedBigInteger('adjustment_id');
            $table->integer('jumlah_barang');
            $table->integer('harga_barang');
            $table->integer('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_adjustment');
    }
}
