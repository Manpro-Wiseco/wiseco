<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->foreign('data_bank_id')->references('id')->on('data_bank');
            $table->unsignedBigInteger('data_bank_id')->after('company_id');
            $table->integer('total_pembayaran')->nullable()->after('data_bank_id');
            $table->integer('sisa_pembayaran')->nullable()->after('total_pembayaran');
            $table->integer('status_pembayaran')->nullable()->after('sisa_pembayaran');
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
            Schema::drop('data_bank_id');
            Schema::enableForeignKeyConstraints();
            $table->dropColumn('total_pembayaran');
            $table->dropColumn('sisa_pembayaran');
            $table->dropColumn('status_pembayaran');
        });
    }
}
