<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'nameItem' => 'Barang 1',
            'codeItem' => 'B-001',
            'descriptionItem' => 'Mock Barang di database',
            'unitItem' => 'Pcs',
            'priceItem' => '10000',
            'costItem' => '5000',
            'stockItem' => '100',
            'company_id' => '1',
        ]);
    }
}
