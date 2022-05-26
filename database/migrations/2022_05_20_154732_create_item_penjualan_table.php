<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreign('item_id')->references('id')->on('items');
            $table->unsignedBigInteger('item_id');
            $table->foreign('pesanan_penjualan_id')->references('id')->on('pesanan_penjualan')->onDelete('set null');
            $table->unsignedBigInteger('pesanan_penjualan_id')->nullable();
            $table->integer('jumlah_barang');
            $table->integer('harga_barang');
            $table->integer('subtotal');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_penjualan');
    }
}
