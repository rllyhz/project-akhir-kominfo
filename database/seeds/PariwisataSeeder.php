<?php

use App\Pariwisata;
use Illuminate\Database\Seeder;

class PariwisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tahun = [2005, 2006, 2007, 2008];
        $nama_tempat_wisata = [
            'Pagoda Avalokitesvara',
            'Klenteng Sam Poo Koong',
            'Ayana Gedong Songo',
            'Curug Lawe',
            'Kebun Teh Medini',
            'Watu Gunung New Sabana',
            'Rawa Pening',
            'Pondok Kopi Umbul Sidomukti',
            'Vanaprastha Gedong Songo Park',
        ];
        $data_pariwisata = [];

        for ($i = 0; $i < count($tahun); $i++) {
            for ($j = 0; $j < count($nama_tempat_wisata); $j++) {
                array_push($data_pariwisata, [
                    'tahun' => $tahun[$i],
                    'nama_wisata' => $nama_tempat_wisata[$j],
                    'jumlah_wisatawan' => random_int(30, 200),
                ]);
            }
        }

        foreach ($data_pariwisata as $dp) {
            Pariwisata::create([
                'tahun' => $dp['tahun'],
                'nama_wisata' => $dp['nama_wisata'],
                'jumlah_wisatawan' => $dp['jumlah_wisatawan'],
            ]);
        }
    }
}
