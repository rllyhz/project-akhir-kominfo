<?php

use App\JenjangPendidikan;
use Illuminate\Database\Seeder;

class JenjangPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenjang_pendidikan = [
            [
                'nama_jenjang_pendidikan' => "SD",
            ],
            [
                'nama_jenjang_pendidikan' => "SMP",
            ],
            [
                'nama_jenjang_pendidikan' => "SMA/SMK",
            ],
        ];

        foreach ($jenjang_pendidikan as $jp) {
            JenjangPendidikan::create([
                'nama_jenjang_pendidikan' => $jp['nama_jenjang_pendidikan'],
            ]);
        }
    }
}
