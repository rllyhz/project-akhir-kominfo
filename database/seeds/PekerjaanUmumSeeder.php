<?php

use Illuminate\Database\Seeder;
use App\PekerjaanUmum;

class PekerjaanUmumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        $tahun = [2015, 2016, 2017, 2018];
        $sumber_dana = [
            'APBN',
            'APBD',
            'Luar Negeri',
            'Sumber dana Lainya',
        ];
        $data_pekerjaanUmum = [];

        for ($i = 0; $i < count($tahun); $i++) {
            for ($j = 0; $j < count($sumber_dana); $j++) {
                array_push($data_pekerjaanUmum, [
                    'tahun' => $tahun[$i],
                    'sumber_dana' => $sumber_dana[$j],
                    'jumlah_dana' => random_int(50, 100) . "0000000",
                ]);
            }
        }

        foreach ($data_pekerjaanUmum as $dp) {
            PekerjaanUmum::create([
                'tahun' => $dp['tahun'],
                'sumber_dana' => $dp['sumber_dana'],
                'jumlah_dana' => $dp['jumlah_dana'],
            ]);
        }
    }
}
