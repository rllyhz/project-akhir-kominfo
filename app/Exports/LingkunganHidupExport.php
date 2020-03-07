<?php

namespace App\Exports;

use App\LingkunganHidup;
use Maatwebsite\Excel\Concerns\FromCollection;

class LingkunganHidupExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return LingkunganHidup::all();
    }
}
