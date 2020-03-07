<?php

namespace App\Exports;

use App\Kependudukan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KependudukanExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return Kependudukan::all();
    }
    public function headings():array{
        return [
            "#",
            "Tahun",
            "Kecamatan",
            "Status",
            "Jumlah",
            "created_add",
            "updated_add"
        ];
    }
}
