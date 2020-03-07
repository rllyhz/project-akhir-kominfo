<?php

namespace App\Imports;

use App\PenanggulanganBencana;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenanggulanganBencanaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new PenanggulanganBencana([
            'tahun'  => $row['tahun'],
            'penyebab' => $row['penyebab'],
            'tempat_kebakaran'    => $row['tempat_kebakaran'],
            "jumlah" =>$row['jumlah']
        ]);
    }
}

