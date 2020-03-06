<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenjangPendidikan extends Model
{
    protected $table = "jenjang_pendidikan";
    protected $fillable = ["nama_jenjang_pendidikan"];

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class);
    }
}
