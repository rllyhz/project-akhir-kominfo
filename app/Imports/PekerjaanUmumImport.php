<?php

namespace App\Imports;

use App\PekerjaanUmum;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PekerjaanUmumImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new PekerjaanUmum([
            'tahun'  => $row['tahun'],
            'sumber_dana' => $row['sumber_dana'],
            'jumlah_dana'    => $row['jumlah_dana'],
        ]);
    }
}
