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
                'nama_penyakit' => "Radang Tenggorokan",
                'deskripsi_penyakit' => "Penyakit yang disebabkan oleh virus",
            ],
            [
                'nama_penyakit' => "TBC/Tuberculosis",
                'deskripsi_penyakit' => "Penyakit yang disebabkan oleh virus juga",
            ],
            [
                'nama_penyakit' => "Malaria",
                'deskripsi_penyakit' => "Penyakit dari gigitan nyamuk",
            ],
            [
                'nama_penyakit' => "Kholera/Cholera",
                'deskripsi_penyakit' => "Penyakit Kolera",
            ],
            [
                'nama_penyakit' => "DBD/Demam Berdarah",
                'deskripsi_penyakit' => "Penyakit Kolera",
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
