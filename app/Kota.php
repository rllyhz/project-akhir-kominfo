<?php

namespace App;

use App\Sekolah;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = "kota";
    protected $fillable = ["nama_kota"];

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class);
    }
}
