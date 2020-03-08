<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KasusPenyakit extends Model
{
    protected $table = "kasus_penyakit";
    protected $fillable = ['tahun', 'jenis_penyakit_id', 'jumlah'];
}
