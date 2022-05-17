<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_penjualan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('no_pesanan')->nullable();
            $table->string('deskripsi');
            $table->integer('nilai');
            $table->enum('status', ['DITERIMA','DITOLAK','DRAFT']);
            $table->foreign('pelanggan_id')->references('id')->on('data_contact');
            $table->unsignedBigInteger('pelanggan_id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('pesanan_penjualan');
    }
}
