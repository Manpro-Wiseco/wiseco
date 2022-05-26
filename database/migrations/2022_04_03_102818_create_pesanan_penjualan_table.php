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
            $table->string('no_pesanan', 100)->nullable();
            $table->string('deskripsi', 400)->nullable();
            $table->integer('nilai');
            $table->enum('status', ['DITERIMA','DITOLAK','DRAFT','UNKNOWN'])->default('DRAFT');
            $table->foreign('pelanggan_id')->references('id')->on('data_contact');
            $table->unsignedBigInteger('pelanggan_id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('pesanan_penjualan');
    }
}
