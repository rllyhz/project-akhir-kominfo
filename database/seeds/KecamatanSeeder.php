<?php

use App\Kecamatan;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kecamatan = [
            [
                "nama_kecamatan" => "Banyumanik",
            ],
            [
                "nama_kecamatan" => "Candisari",
            ],
            [
                "nama_kecamatan" => "Gajahmungkur",
            ],
            [
                "nama_kecamatan" => "Gayamsari",
            ],
            [
                "nama_kecamatan" => "Genuk",
            ],
            [
                "nama_kecamatan" => "Gunungpati",
            ],
            [
                "nama_kecamatan" => "Mijen",
            ],
        ];

        foreach ($kecamatan as $k) {
            Kecamatan::create([
                "nama_kecamatan" => $k["nama_kecamatan"],
            ]);
        }
    }
}
