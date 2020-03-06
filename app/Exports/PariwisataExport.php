<?php

namespace App\Exports;

use App\Pariwisata;
use Maatwebsite\Excel\Concerns\FromCollection;

class PariwisataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return Pariwisata::all();
    }
}
