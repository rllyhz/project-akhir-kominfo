<?php

namespace App\Http\Controllers;

use App\Exports\SekolahExport;
use App\Imports\SekolahImport;
use Illuminate\Http\Request;
use App\Sekolah;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sekolah = Sekolah::all();

        $total_sekolah = 0;
        foreach ($sekolah as $item) {
            $total_sekolah += intval($item->jumlah);
        }

        return view('admin.sekolah.index', [
            'sekolah' => $sekolah,
            'total_sekolah' => $total_sekolah,
        ]);
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
        Sekolah::create([
            'tahun' => $request->tahun,
            'kota' => $request->kota,
            'jenjang_pendidikan' => $request->jenjangPendidikan,
            'jenis_sekolah' => $request->jenisSekolah,
            'jumlah' => $request->jumlahSekolah,
        ]);

        return redirect()->route('admin.sekolah.index')->with('info', [
            'status' => 'success',
            'pesan' => 'Data sekolah berhasil disimpan!',
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
        $sekolah = Sekolah::findOrFail($id);
        return view('admin.sekolah.edit', compact('sekolah'));
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
        $sekolah = Sekolah::findOrFail($id);

        $sekolah->kota = $request->kota;
        $sekolah->jenis_sekolah = $request->jenis_sekolah;
        $sekolah->jenjang_pendidikan = $request->jenjang_pendidikan;
        $sekolah->tahun = $request->tahun;
        $sekolah->jumlah = $request->jumlah;

        if ($sekolah->save()) {
            return redirect()->route('admin.sekolah.index')->with('info', [
                'status' => 'success',
                'pesan' => 'Berhasil mengedit data sekolah!',
            ]);
        } else {
            return redirect()->route('admin.sekolah.index')->with('info', [
                'status' => 'danger',
                'pesan' => 'Gagal mengedit data sekolah!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sekolah = Sekolah::findOrFail($id);

        if ($sekolah->delete()) {
            return redirect()->route('admin.sekolah.index')->with('info', [
                'status' => 'success',
                'pesan' => 'Berhasil menghapus data sekolah!',
            ]);
        } else {
            return redirect()->route('admin.sekolah.index')->with('info', [
                'status' => 'success',
                'pesan' => 'Berhasil menghapus data sekolah!',
            ]);
        }
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
        ]);

        $file = $request->file('file');
        $valid_extension = [
            'xls',
            'xlsx',
        ];
        $extension_file = $file->getClientOriginalExtension();
        // $mimeType = $file->getMimeType();

        if (!in_array($extension_file, $valid_extension)) {
            return redirect()->route('admin.sekolah.index')->with('info', [
                'status' => 'danger',
                'pesan' => 'Maaf.. File yang anda upload bukan file excel. Silahkan upload file dengan extension <strong>xls</strong> atau <strong>xlsx</strong>!',
            ]);
        }

        if ($file->getSize() > 1000000) {
            return redirect()->route('admin.sekolah.index')->with('info', [
                'status' => 'danger',
                'pesan' => 'Maaf.. File yang anda upload melebihi ukuran maksimal. Maksimal file kurang dari 10mb <strong>xlx</strong> atau <strong>xlxs</strong>!',
            ]);
        }

        if (Excel::import(new SekolahImport, $file->getRealPath())) {
            $nama_file_baru = time() . '_' . $file->getClientOriginalName();
            $file->move('file_excel/data_sekolah', $nama_file_baru);

            $file_import = 'file_excel' . DIRECTORY_SEPARATOR . 'data_sekolah' . DIRECTORY_SEPARATOR . $nama_file_baru;

            if (File::delete($file_import)) {
                return redirect()->route('admin.sekolah.index')->with('info', [
                    'status' => 'success',
                    'pesan' => 'Berhasil mengimport file ' . $file->getClientOriginalName() . '!',
                ]);
            }
        } else {
            return redirect()->route('admin.sekolah.index')->with('info', [
                'status' => 'danger',
                'pesan' => 'Gagal mengimport file ' . $file->getClientOriginalName() . '!',
            ]);
        }
    }

    public function export()
    {
        dd('Hai');
        return Excel::download(new SekolahExport, 'data_sekolah.xlsx');

        // $pdf = PDF::loadview('admin.sekolah.cetak', compact('sekolah'));
        // return $pdf->download('laporan-sekolah-pdf');
    }

    // untuk chart
    public function getDataChart()
    {
        $sekolah = Sekolah::all();

        $total_sekolah = 0;
        foreach ($sekolah as $item) {
            $total_sekolah += intval($item->jumlah);
        }

        $data = [
            'sekolah' => $sekolah,
            'total_sekolah' => $total_sekolah,
        ];

        return json_encode($data);
    }
}
