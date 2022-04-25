<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsinyasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsinyasis', function (Blueprint $table) {
            $table->id();
            $table->date('dateKonsinyasi');
            $table->string('invoiceKonsinyasi');
            $table->string('ReferenceNumber');
            $table->foreign('data_contact_id')->references('id')->on('data_contact');
            $table->unsignedBigInteger('data_contact_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->unsignedBigInteger('item_id');
            $table->string('jumlah_barang');
            $table->string('jumlah_diskon');
            $table->string('total_harga');
            $table->string('keterangan');
            $table->string('status');
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('konsinyasis');
    }
}
