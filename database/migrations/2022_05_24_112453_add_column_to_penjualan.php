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
            $table->foreign('pesanan_id')->references('id')->on('pesanan_penjualan')->onDelete('cascade');
            $table->unsignedBigInteger('pesanan_id')->after('id');
            $table->foreign('data_bank_id')->references('id')->on('data_bank');
            $table->unsignedBigInteger('data_bank_id')->after('company_id');
            $table->integer('total_pembayaran')->nullable()->after('data_bank_id');
            $table->integer('sisa_pembayaran')->nullable()->after('total_pembayaran');
            $table->enum('status_pembayaran', ['LUNAS','KREDIT','CICILAN'])->after('sisa_pembayaran');
            // $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('data_bank_id');
        Schema::dropIfExists('pesanan_id');
        Schema::enableForeignKeyConstraints();

        Schema::table('penjualan', function (Blueprint $table) {
            // $table->dropForeign('data_bank_id');
            $table->dropColumn('total_pembayaran');
            $table->dropColumn('sisa_pembayaran');
            $table->dropColumn('status_pembayaran');
        });
    }
}
