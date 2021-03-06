<?php

namespace Database\Seeders;

use App\Models\Classification;
use App\Models\PenawaranHarga;
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
            ClassificationSeeder::class,
            SubClassificationSeeder::class,
            TicketCategorySeeder::class,
            ItemSeeder::class,
        ]);
    }
}
