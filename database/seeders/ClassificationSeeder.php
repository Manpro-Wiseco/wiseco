<?php

namespace Database\Seeders;

use App\Models\Classification;
use Illuminate\Database\Seeder;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classifications = array(
            array(
                "id" => 1,
                "name" => "Harta",
                "code" => "1",
                "created_at" => "2022-04-12 10:07:53",
                "updated_at" => "2022-04-12 10:07:55",
            ),
            array(
                "id" => 2,
                "name" => "Kewajiban",
                "code" => "2",
                "created_at" => "2022-04-12 10:08:09",
                "updated_at" => "2022-04-12 10:08:10",
            ),
            array(
                "id" => 3,
                "name" => "Modal",
                "code" => "3",
                "created_at" => "2022-04-12 10:08:18",
                "updated_at" => "2022-04-12 10:08:19",
            ),
            array(
                "id" => 4,
                "name" => "Pendapatan",
                "code" => "4",
                "created_at" => "2022-04-12 10:08:26",
                "updated_at" => "2022-04-12 10:08:26",
            ),
            array(
                "id" => 5,
                "name" => "Beban Atas Pendapatan",
                "code" => "5",
                "created_at" => "2022-04-12 10:09:35",
                "updated_at" => "2022-04-12 10:09:36",
            ),
            array(
                "id" => 6,
                "name" => "Beban Operasional",
                "code" => "6",
                "created_at" => "2022-04-12 10:09:50",
                "updated_at" => "2022-04-12 10:09:50",
            ),
            array(
                "id" => 7,
                "name" => "Beban Non Operasional",
                "code" => "7",
                "created_at" => "2022-04-12 10:10:02",
                "updated_at" => "2022-04-12 10:10:03",
            ),
            array(
                "id" => 8,
                "name" => "Pendapatan Lain",
                "code" => "8",
                "created_at" => "2022-04-12 10:10:12",
                "updated_at" => "2022-04-12 10:10:13",
            ),
            array(
                "id" => 9,
                "name" => "Beban Lain",
                "code" => "9",
                "created_at" => "2022-04-12 10:10:27",
                "updated_at" => "2022-04-12 10:10:27",
            ),
        );

        Classification::insert($classifications);
    }
}
