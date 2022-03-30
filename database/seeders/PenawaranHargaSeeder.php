<?php

namespace Database\Seeders;

use App\Models\PenawaranHarga;
use Illuminate\Database\Seeder;

class PenawaranHargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penawaran_harga = array(
            array(
                "date" => "2022-03-29",
                "no_penawaran" => "OR0001",
                "nama_pelanggan" => "Anwar",
                "deskripsi" => "Order --",
                "nilai" => "100,000",
                "status" => "DITERIMA",
            )
        );

        PenawaranHarga::insert($penawaran_harga);
    }
}
