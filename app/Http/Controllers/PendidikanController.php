<?php

namespace App\Http\Controllers;

use App\Sekolah;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    public function index()
    {
        return view('admin.kategori.pendidikan.index');
    }

    public function data_sekolah()
    {
        $data_sekolah = Sekolah::all();
        return view('admin.kategori.pendidikan.data_sekolah', [
            'sekolah' => $data_sekolah,
        ]);
    }
}
