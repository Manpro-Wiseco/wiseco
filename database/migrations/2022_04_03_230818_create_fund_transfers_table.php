<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->nullable();
            $table->string('description');
            $table->date('transaction_date');
            $table->unsignedBigInteger('from_bank_account');
            $table->foreign('from_bank_account')->references('id')->on('bank_accounts');
            $table->unsignedBigInteger('to_bank_account');
            $table->foreign('to_bank_account')->references('id')->on('bank_accounts');
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
        Schema::dropIfExists('fund_transfers');
    }
}
