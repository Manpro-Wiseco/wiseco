<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bank_accounts = array(
            array(
                "id" => 1,
                "name" => "Bank Utama",
                "company_id" => 1,
                "subclassification_id" => 1,
                "data_bank_id" => 8,
                "status" => 1,
                "created_at" => "2022-03-14 15:25:35",
                "updated_at" => "2022-03-14 15:25:35",
            ),
        );
        BankAccount::insert($bank_accounts);
    }
}
