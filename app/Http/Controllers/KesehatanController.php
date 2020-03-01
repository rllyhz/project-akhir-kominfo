<?php

namespace App\Http\Controllers;

use App\Penyakit;
use Illuminate\Http\Request;

class KesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kategori.kesehatan.index');
    }

    public function data_penyakit()
    {
        $penyakit = Penyakit::all();
    }
}
