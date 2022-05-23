<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPenerimaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_penerimaan', function (Blueprint $table) {
            $table->id();
            $table->foreign('item_id')->references('id')->on('items');
            $table->unsignedBigInteger('item_id');
            $table->foreign('penerimaan_id')->references('id')->on('penerimaan_barangs');
            $table->unsignedBigInteger('penerimaan_id');
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
        Schema::dropIfExists('item_penerimaan');
    }
}
