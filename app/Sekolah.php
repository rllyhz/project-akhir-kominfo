<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';
    protected $fillable = [
        'tahun', 'kecamatan_id', 'jenjang_pendidikan_id', 'jenis_sekolah', 'jumlah',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function jenjang_pendidikan()
    {
        return $this->belongsTo(JenjangPendidikan::class);
    }
}
