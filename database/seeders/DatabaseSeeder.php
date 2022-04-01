<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CompanySeeder::class,
            DataBankSeeder::class,
            SubClassificationSeeder::class,
            BankAccountSeeder::class,
            ExpenseSeeder::class,
            TicketCategorySeeder::class,
        ]);
    }
}
