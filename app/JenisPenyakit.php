<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPenyakit extends Model
{
    protected $table = "jenis_penyakit";
    protected $fillable = ['nama_penyakit', 'deskripsi_penyakit'];
}
