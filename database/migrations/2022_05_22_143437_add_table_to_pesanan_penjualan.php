<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableToPesananPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesanan_penjualan', function (Blueprint $table) {
            $table->integer('other_cost')->nullable()->after('status');
            $table->integer('discount')->nullable()->after('other_cost');
            $table->integer('potongan')->nullable()->after('discount');
            $table->integer('pajak')->nullable()->after('potongan');
            // $table->renameColumn('nilai', 'jmlTotal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesanan_penjualan', function (Blueprint $table) {
            $table->dropColumn('other_cost');
            $table->dropColumn('discount');
            $table->dropColumn('potongan');
            $table->dropColumn('pajak');
            // $table->renameColumn('jmlTotal', 'nilai');
        });
    }
}
