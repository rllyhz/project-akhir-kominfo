<?php

namespace App\Exports;

use App\Penyakit;
use Maatwebsite\Excel\Concerns\FromCollection;

class PenyakitExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Penyakit::all();
    }
}
