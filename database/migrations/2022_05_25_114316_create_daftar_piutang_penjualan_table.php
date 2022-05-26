<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarPiutangPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_piutang_penjualan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_awal_kredit');
            $table->date('tanggal_akhir_kredit');
            $table->string('no_piutang',100);
            $table->integer('sisa_piutang');
            $table->integer('tenor');
            $table->integer('bunga');
            $table->integer('beban_pembayaran');
            $table->enum('status', ['PENDING','BELUM LUNAS','LUNAS'])->default('PENDING');
            $table->foreign('penjualan_id')->references('id')->on('penjualan')->onDelete('cascade');
            $table->unsignedBigInteger('penjualan_id');
            $table->foreign('pelanggan_id')->references('id')->on('data_contact')->onDelete('set null');
            $table->unsignedBigInteger('pelanggan_id')->nullable();
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
        Schema::dropIfExists('daftar_piutang_penjualan');
    }
}
