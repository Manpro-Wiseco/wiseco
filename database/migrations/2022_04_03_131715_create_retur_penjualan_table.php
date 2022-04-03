<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retur_penjualan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('no_retur');
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
        Schema::dropIfExists('retur_penjualan');
    }
}
