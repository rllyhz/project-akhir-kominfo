<?php

use Illuminate\Database\Seeder;
use App\PenanggulanganBencana;

class PenanggulanganBencanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tahun = [2015, 2019, 2018, 2016];
        $penyebab = [
            'Konsleting Listrik',
            'Kebocoran Gas',
            'Selang Bocor',
            'Lainnya',
        ];
        $tempat_kebakaran = [
            'Tempat Tinggal',
            'Ruko',
            'Kos',
            'Tempat Ibadah',
            'Lainnya',
        ];
        $jumlah = ['Negeri', 'Swasta'];
        $data_penanggulanganBencana = [];

        for ($i = 0; $i < count($tahun); $i++) {
            for ($j = 0; $j < count($penyebab); $j++) {
                for ($k = 0; $k < count($tempat_kebakaran); $k++) {
                    array_push($data_penanggulanganBencana, [
                        'tahun' => $tahun[$i],
                        'penyebab' => $penyebab[$j],
                        'tempat_kebakaran' => $tempat_kebakaran[$k],
                        'jumlah' => random_int(1, 20),
                    ]);
                }
            }
        }

        foreach ($data_penanggulanganBencana as $ds) {
            PenanggulanganBencana::create([
                'tahun' => $ds['tahun'],
                'penyebab' => $ds['penyebab'],
                'tempat_kebakaran' => $ds['tempat_kebakaran'],
                'jumlah' => $ds['jumlah'],
            ]);
        }
    }
}
