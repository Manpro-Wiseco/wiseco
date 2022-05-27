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
            $table->date('tanggal_retur');
            $table->string('no_retur', 100);
            $table->string('deskripsi', 400)->nullable();
            $table->enum('status', ['PENDING','DIPROSES','DIKIRIM','DITERIMA','DITOLAK','BATAL'])->default('PENDING');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('company_id');
            $table->foreign('penjualan_id')->references('id')->on('penjualan');
            $table->unsignedBigInteger('penjualan_id')->onDelete('cascade');
            $table->foreign('pelanggan_id')->references('id')->on('data_contact')->onDelete('cascade');
            $table->unsignedBigInteger('pelanggan_id');
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
