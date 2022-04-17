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
            $table->string('nama_pelanggan');
            $table->string('deskripsi');
            $table->integer('nilai');
            $table->enum('status', ['DITERIMA','DITOLAK','DRAFT']);
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
