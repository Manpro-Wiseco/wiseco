<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPengirimanBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengiriman_barang', function (Blueprint $table) {
            $table->integer('ongkos_kirim')->default(0)->nullable()->after('kurir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengiriman_barang', function (Blueprint $table) {
            $table->dropColumn('ongkos_kirim');
        });
    }
}
