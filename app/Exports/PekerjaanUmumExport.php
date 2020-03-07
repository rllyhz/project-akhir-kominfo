<?php

namespace App\Exports;

use App\PekerjaanUmum;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
class PekerjaanUmumExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return PekerjaanUmum::all();
    }
    public function headings():array{
        return [
            "#",
            "Tahun",
            "Sumber Dana",
            "Jumlah Dana",
            "created_add",
            "updated_add"
        ];
    }
}
