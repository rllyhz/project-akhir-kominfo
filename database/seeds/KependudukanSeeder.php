<?php

use Illuminate\Database\Seeder;
use App\Kependudukan;

class KependudukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        $tahun = [2016, 2017, 2018, 2019];
        $kecamatan_id = [1, 2, 3, 5, 6, 7];
        $status = [
            'Kelahiran',
            'Kematian',
            'Usia 0-11',
            'Usia 12-25',
            'Usia  26-45',
            'Usia Lansia',
        ];
        
        $data_kependudukan = [];

        for ($i = 0; $i < count($tahun); $i++) {
            for ($j = 0; $j < count($kecamatan_id); $j++) {
                for ($k = 0; $k < count($status); $k++) {
                        array_push($data_kependudukan, [
                            'tahun' => $tahun[$i],
                            'kecamatan_id' => $kecamatan_id[$j],
                            'status' => $status[$k],
                            'jumlah' => random_int(1, 30),
                        ]);
                }
            }
        }

        foreach ($data_kependudukan as $ds) {
            Kependudukan::create([
                'tahun' => $ds['tahun'],
                'kecamatan_id' => $ds['kecamatan_id'],
                'status' => $ds['status'],
                'jumlah' => $ds['jumlah'],
            ]);
        }
    }
}
