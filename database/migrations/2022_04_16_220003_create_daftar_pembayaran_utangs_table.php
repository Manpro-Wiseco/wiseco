<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarPembayaranUtangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_pembayaran_utangs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('no_pesanan');
            $table->unsignedBigInteger('data_contact_id');
            $table->foreign('data_contact_id')->references('id')->on('data_contact');
            $table->unsignedBigInteger('pesanan_pembelian_id');
            $table->foreign('pesanan_pembelian_id')->references('id')->on('pesanan_pembelians');
            $table->unsignedBigInteger('data_bank_id')->nullable();
            $table->foreign('data_bank_id')->references('id')->on('data_bank');
            $table->string('nama_pelanggan');
            $table->string('deskripsi');
            $table->integer('nilai');
            $table->enum('status', ['DITERIMA','DITOLAK','DRAFT']);
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
        Schema::dropIfExists('daftar_pembayaran_utangs');
    }
}
