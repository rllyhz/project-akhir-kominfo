<?php

namespace App\Imports;

use App\Kependudukan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KependudukanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Kependudukan([
            'tahun'  => $row['tahun'],
            'kecamatan_id' => $row['kecamatan'],
            'status'    => $row['status'],
            "jumlah" =>$row['jumlah']
        ]);
    }
}