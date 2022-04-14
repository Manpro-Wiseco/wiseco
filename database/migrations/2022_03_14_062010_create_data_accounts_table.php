<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('data_bank_id')->nullable();
            $table->foreign('data_bank_id')->references('id')->on('data_bank');
            $table->unsignedBigInteger('subclassification_id');
            $table->foreign('subclassification_id')->references('id')->on('subclassifications');
            $table->boolean('is_cash')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('status'); // 1 = Bisnis, 0 = Pribadi
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
        Schema::dropIfExists('bank_accounts');
    }
}
