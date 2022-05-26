<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman_barang', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengiriman');
            $table->string('no_pengiriman',100);
            $table->string('kurir',100);
            $table->string('deskripsi',400);
            $table->enum('status', ['DIKIRIM','RETURN','BATAL', 'HILANG']);
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('company_id');
            $table->foreign('penjualan_id')->references('id')->on('penjualan');
            $table->unsignedBigInteger('penjualan_id');
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
        Schema::dropIfExists('pengiriman_barang');
    }
}
