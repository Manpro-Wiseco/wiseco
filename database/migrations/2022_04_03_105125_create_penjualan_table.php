<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('no_penjualan',100)->nullable();
            $table->date('tanggal');
            $table->string('nama_pelanggan',400);
            $table->string('deskripsi')->nullable();
            $table->integer('nilai');
            $table->enum('status', ['DRAFT','DITERIMA','DITOLAK','DIKIRIM','RETUR','DIPROSES', 'SELESAI'])->default('DRAFT');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('company_id');
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
        Schema::dropIfExists('penjualan');
    }
}
