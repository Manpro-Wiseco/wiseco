<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryPembayaranPiutangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_pembayaran_piutang', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pembayaran');
            $table->integer('total_pembayaran');
            $table->integer('sisa_pembayaran');
            $table->enum('status', ['PENDING','BELUM LUNAS','LUNAS','PENGEMBALIAN'])->default('PENDING');
            $table->foreign('data_bank_id')->references('id')->on('data_bank')->onDelete('set null');
            $table->unsignedBigInteger('data_bank_id')->nullable();
            $table->foreign('piutang_id')->references('id')->on('daftar_piutang_penjualan')->onDelete('cascade');
            $table->unsignedBigInteger('piutang_id');
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
        Schema::dropIfExists('history_pembayaran_piutang');
    }
}
