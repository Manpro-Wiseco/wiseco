<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_contact_id');
            $table->foreign('data_contact_id')->references('id')->on('data_contact');
            $table->unsignedBigInteger('income_id');
            $table->foreign('income_id')->references('id')->on('incomes');
            $table->bigInteger('amount');
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
        Schema::dropIfExists('detail_incomes');
    }
}
