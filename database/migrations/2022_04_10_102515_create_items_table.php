<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nameItem');
            $table->string('codeItem')->nullable();
            $table->string('descriptionItem')->nullable();
            $table->string('unitItem')->nullable();
            $table->string('classificationItem')->nullable();
            $table->string('costItem')->nullable();
            $table->string('priceItem')->nullable();
            $table->string('stockItem')->nullable();
            $table->string('stockMinItem')->nullable();
            $table->string('pajakPembelianItem')->nullable();
            $table->string('pajakPenjualanItem')->nullable();
            $table->string('photoItem')->nullable();
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
        Schema::dropIfExists('items');
    }
}
