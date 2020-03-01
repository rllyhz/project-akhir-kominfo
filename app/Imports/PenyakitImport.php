<?php

namespace App\Imports;

use App\Penyakit;
use Maatwebsite\Excel\Concerns\ToModel;

class PenyakitImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Penyakit([
            'tahun' => $row[0],
            'jenis_penyakit' => ucwords($row[1]),
            'jumlah' => $row[2],
        ]);
    }
}
