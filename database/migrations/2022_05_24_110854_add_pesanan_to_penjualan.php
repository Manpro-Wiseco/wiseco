<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPesananToPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->foreign('penjualan_id')->references('id')->on('pesanan_penjualan')->after('id');
            $table->unsignedBigInteger('penjualan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            Schema::drop('penjualan_id');
            Schema::enableForeignKeyConstraints();
        });
    }
}
