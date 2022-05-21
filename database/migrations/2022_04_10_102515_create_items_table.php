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
            $table->enum('unitItem', ['Box', 'Pcs', 'Kg', 'Cup', 'Unit']);
            $table->integer('costItem')->nullable();
            $table->integer('priceItem')->nullable();
            $table->integer('stockItem')->nullable();
            $table->string('pajakPembelianItem')->nullable();
            $table->string('pajakPenjualanItem')->nullable();
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
