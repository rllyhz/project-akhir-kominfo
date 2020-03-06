<?php

namespace App\Imports;

use App\Sekolah;
use Maatwebsite\Excel\Concerns\ToModel;

class SekolahImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Sekolah([
            'tahun' => $row[0],
            'kecamatan_id' => $row[1],
            'jenjang_pendidikan_id' => strtoupper($row[2]),
            'jenis_sekolah' => ucwords($row[3]),
            'jumlah' => $row[4],
        ]);
    }
}
