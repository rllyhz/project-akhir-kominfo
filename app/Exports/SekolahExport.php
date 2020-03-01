<?php

namespace App\Exports;

use App\Sekolah;
use Maatwebsite\Excel\Concerns\FromCollection;

class SekolahExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sekolah::all();
    }
}
