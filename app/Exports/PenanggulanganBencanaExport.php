<?php

namespace App\Exports;

use App\PenanggulanganBencana;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
class PenanggulanganBencanaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return PenanggulanganBencana::all();
    }
    public function headings():array{
        return [
            "#",
            "Tahun",
            "Penyebab",
            "Tempat_kebakaran",
            "Jumlah",
            "created_add",
            "updated_add",
        ];
    }
}
