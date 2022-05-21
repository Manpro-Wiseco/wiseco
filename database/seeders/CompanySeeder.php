<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::Create([
            'id' => 1,
            'name' => 'Inventory Company',
            'business_type' => 'Persediaan barang pangan dan papan',
            'user_id' => 2,
            'address' => 'Jl. Raya Kedungwungkal No. 1',
            'status' => 'Dalam Negeri',
            'city' => 'Kota Bandung',
            'province' => 'Jawa Barat',
            'country' => 'Indonesia',
            'phone' => '081234567890',
            'email' => 'exampleInv@gmail.com',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
