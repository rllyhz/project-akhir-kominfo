<?php

namespace App\Imports;

use App\Pariwisata;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PariwisataImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        return new Pariwisata([
            //
            'tahun' => $collection[1],
                'nama_wisata' =>$collection[2],
                'jumlah_wisatawan' =>$collection[3],
                
        ]);
    }}
