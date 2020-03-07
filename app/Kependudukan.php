<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kependudukan extends Model
{
    //
    protected $fillable =["tahun","kecamatan_id","status","jumlah","crated_at","updated_at"];
}
