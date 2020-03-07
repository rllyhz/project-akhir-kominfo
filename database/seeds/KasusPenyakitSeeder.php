<?php

use App\KasusPenyakit;
use Illuminate\Database\Seeder;

class KasusPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tahun = [2002, 2003, 2004, 2005];
        $jenis_penyakit_id = [1, 2, 3];
        $data_kasus_penyakit = [];

        for ($i = 0; $i < count($tahun); $i++) {
            for ($j = 0; $j < count($jenis_penyakit_id); $j++) {
                array_push($data_kasus_penyakit, [
                    'tahun' => $tahun[$i],
                    'jenis_penyakit_id' => $jenis_penyakit_id[$j],
                    'jumlah' => random_int(5, 50),
                ]);
            }
        }

        foreach ($data_kasus_penyakit as $dkp) {
            KasusPenyakit::create([
                'tahun' => $dkp['tahun'],
                'jenis_penyakit_id' => $dkp['jenis_penyakit_id'],
                'jumlah' => $dkp['jumlah'],
            ]);
        }
    }
}
