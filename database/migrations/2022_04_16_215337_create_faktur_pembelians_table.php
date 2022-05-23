<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faktur_pembelians', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('no_faktur');
            $table->unsignedBigInteger('data_contact_id');
            $table->foreign('data_contact_id')->references('id')->on('data_contact');
            $table->unsignedBigInteger('pesanan_pembelian_id');
            $table->foreign('pesanan_pembelian_id')->references('id')->on('pesanan_pembelians');

            $table->string('deskripsi');
            $table->integer('nilai');
            $table->enum('status', ['DITERIMA','DITOLAK','DRAFT']);
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('faktur_pembelians');
    }
}
