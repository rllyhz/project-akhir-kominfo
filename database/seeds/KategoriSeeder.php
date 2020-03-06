<?php

use App\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = [
            [
                'jenis_kategori' => 'Pendidikan',
                'gambar' => 'avatar.png',
                'deskripsi' => 'Pendidikan',
            ],
            [
                'jenis_kategori' => 'Kesehatan',
                'gambar' => 'avatar.png',
                'deskripsi' => 'Kesehatan',
            ],
            [
                'jenis_kategori' => 'Kependudukan',
                'gambar' => 'avatar.png',
                'deskripsi' => 'Kependudukan',
            ],
        ];

        foreach ($kategori as $k) {
            Kategori::create([
                'jenis_kategori' => $k['jenis_kategori'],
                'gambar' => $k['gambar'],
                'deskripsi' => $k['deskripsi'],
            ]);
        }
    }
}
