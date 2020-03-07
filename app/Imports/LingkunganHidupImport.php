<?php

namespace App\Imports;

use App\LingkunganHidup;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class LingkunganHidupImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        return new LingkunganHidup([
                'tahun' => $collection[1],
                'jenis_rumah' =>$collection[2],
                'debit_air' =>$collection[3],
                
        ]);
    }
}
