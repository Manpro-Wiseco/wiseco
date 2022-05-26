<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faktur_penjualan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_cetak');
            $table->string('no_faktur');
            $table->enum('status', ['DICETAK','BELUM DICETAK'])->default('BELUM DICETAK');
            $table->foreign('penjualan_id')->references('id')->on('penjualan')->onDelete('cascade');
            $table->unsignedBigInteger('penjualan_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('company_id');
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
        Schema::dropIfExists('faktur_penjualan');
    }
}
