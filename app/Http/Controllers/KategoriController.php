<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'gambar' => ['required'],
            'jenis_kategori' => ['required'],
            'deskripsi' => ['required'],
        ]);

        $file = $request->file('gambar');
        $valid_extension = [
            'jpg',
            'jpeg',
            'png',
        ];
        $extension_file = $file->getClientOriginalExtension();
        // $mimeType = $file->getMimeType();

        if (!in_array($extension_file, $valid_extension)) {
            return redirect()->route('admin.kategori.index')->with('info', [
                'status' => 'danger',
                'pesan' => 'Maaf.. File yang anda upload bukan file gambar. Silahkan upload file dengan extension <strong>.jpg</strong>, <strong>.jpeg</strong> atau <strong>.png</strong>!',
            ]);
        }

        if ($file->getSize() > 400000) {
            return redirect()->route('admin.kategori.index')->with('info', [
                'status' => 'danger',
                'pesan' => 'Maaf.. File yang anda upload melebihi ukuran maksimal. Maksimal file kurang dari 4mb!',
            ]);
        }

        $nama_file_baru = time() . '_' . $file->getClientOriginalName();
        $file->move('images/kategori', $nama_file_baru);

        Kategori::create([
            'gambar' => $nama_file_baru,
            'jenis_kategori' => $request->jenis_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.kategori.index')->with('info', [
            'status' => 'success',
            'pesan' => 'Kategori berhasil ditambahkan!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $semuaKategori = Kategori::all();
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', [
            'semuaKategori' => $semuaKategori,
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
