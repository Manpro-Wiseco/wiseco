<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->nullable();
            $table->string('description');
            $table->date('transaction_date');
            $table->unsignedBigInteger('data_contact_id');
            $table->foreign('data_contact_id')->references('id')->on('data_contact');
            $table->unsignedBigInteger('to_account_id');
            $table->foreign('to_account_id')->references('id')->on('data_accounts');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->bigInteger('total');
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
        Schema::dropIfExists('incomes');
    }
}
