<?php

use App\JenisPenyakit;
use Illuminate\Database\Seeder;

class JenisPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis_penyakit = [
            [
                'nama_penyakit' => "Korona",
                'deskripsi_penyakit' => "Penyakit yang disebabkan oleh virus",
            ],
            [
                'nama_penyakit' => "TBC",
                'deskripsi_penyakit' => "Penyakit yang disebabkan oleh virus juga",
            ],
            [
                'nama_penyakit' => "Kusta",
                'deskripsi_penyakit' => "Penyakit Kusta",
            ],
        ];

        foreach ($jenis_penyakit as $jp) {
            JenisPenyakit::create([
                'nama_penyakit' => $jp['nama_penyakit'],
                'deskripsi_penyakit' => $jp['deskripsi_penyakit'],
            ]);
        }
    }
}
