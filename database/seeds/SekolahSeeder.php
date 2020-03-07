<?php

use App\Sekolah;
use Illuminate\Database\Seeder;

class SekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tahun = [2001, 2002, 2004, 2005];
        $kecamatan_id = [1, 2, 3, 5, 6, 7];
        $jenjang_pendidikan_id = [1, 2, 3];
        $jenis_sekolah = ['Negeri', 'Swasta'];
        $data_sekolah = [];

        for ($i = 0; $i < count($tahun); $i++) {
            for ($j = 0; $j < count($kecamatan_id); $j++) {
                for ($k = 0; $k < count($jenjang_pendidikan_id); $k++) {
                    for ($l = 0; $l < count($jenis_sekolah); $l++) {
                        array_push($data_sekolah, [
                            'tahun' => $tahun[$i],
                            'kecamatan_id' => $kecamatan_id[$j],
                            'jenjang_pendidikan_id' => $jenjang_pendidikan_id[$k],
                            'jenis_sekolah' => $jenis_sekolah[$l],
                            'jumlah' => random_int(1, 5),
                        ]);
                    }
                }
            }
        }

        foreach ($data_sekolah as $ds) {
            Sekolah::create([
                'tahun' => $ds['tahun'],
                'kecamatan_id' => $ds['kecamatan_id'],
                'jenjang_pendidikan_id' => $ds['jenjang_pendidikan_id'],
                'jenis_sekolah' => $ds['jenis_sekolah'],
                'jumlah' => $ds['jumlah'],
            ]);
        }
    }
}
