<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturUtangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faktur_utang', function (Blueprint $table) {
            $table->id();
            $table->foreign('faktur_pembelians_id')->references('id')->on('faktur_pembelians');
            $table->unsignedBigInteger('faktur_pembelians_id');
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
        Schema::dropIfExists('faktur_utang');
    }
}
