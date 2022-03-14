<?php

namespace Database\Seeders;

use App\Models\Subclassification;
use Illuminate\Database\Seeder;

class SubClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subclassifications = array(
            array(
                "id" => 1,
                "name" => "Bank",
                "created_at" => "2022-03-14 15:20:43",
                "updated_at" => "2022-03-14 15:20:44",
            ),
            array(
                "id" => 2,
                "name" => "Dompet Digital",
                "created_at" => "2022-03-14 15:20:57",
                "updated_at" => "2022-03-14 15:20:58",
            ),
        );

        Subclassification::insert($subclassifications);
    }
}
