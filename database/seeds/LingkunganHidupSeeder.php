<?php

use Illuminate\Database\Seeder;
use App\LingkunganHidup;
class LingkunganHidupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $tahun = [2015, 2016, 2017, 2018];
        $jenis_rumah = [
            'Rumah Tempat Tinggal',
            'Tempat Peribadatan',
            'Instansi Pemerintahan',
            'Hotel',
            'Sarana Umum',
            'Badan Sosial dan Rumah Sakit',
            'Perusahaan, Toko, Industri',
            'Lain-lain',
            
        ];
        $data_lingkunganHidup = [];

        for ($i = 0; $i < count($tahun); $i++) {
            for ($j = 0; $j < count($jenis_rumah); $j++) {
                array_push($data_lingkunganHidup, [
                    'tahun' => $tahun[$i],
                    'jenis_rumah' => $jenis_rumah[$j],
                    'debit_air' => mt_rand(1, 10)/3*2,
                ]);
            }
        }

        foreach ($data_lingkunganHidup as $dp) {
            LingkunganHidup::create([
                'tahun' => $dp['tahun'],
                'jenis_rumah' => $dp['jenis_rumah'],
                'debit_air' => $dp['debit_air'],
            ]);
        }
    }
   
}
