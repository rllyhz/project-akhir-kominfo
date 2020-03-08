<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\PekerjaanUmum;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exports\PekerjaanUmumExport;
use App\Imports\PekerjaanUmumImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DataTables;

class PekerjaanUmumController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PekerjaanUmum::all();
            return DataTables::of($data)

                ->addColumn('action', function ($row) {
                    $btn = '<a href="pekerjaanUmum/' . $row->id . '/edit" class="edit btn btn-success btn-sm">Edit</a>';
                    $btn  .= '<form action="pekerjaanUmum/' . $row->id . '" method="post" style="display:inline;">
                        <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin hapus ?\')"><i class="fas fa-trash"></i> Delete</button></form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin/pekerjaanUmum/index');
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
        //
        $request->validate([
            'tahun' => 'required',
            'sumber_dana' => 'required',
            'jumlah_dana' => 'required',
        ]);
        $pekerjaanUmum = new PekerjaanUmum;
        $pekerjaanUmum->tahun = $request->tahun;
        $pekerjaanUmum->sumber_dana = $request->sumber_dana;
        $pekerjaanUmum->jumlah_dana = $request->jumlah_dana;
        $pekerjaanUmum->save();
        return redirect('admin/pekerjaanUmum')->with('status', 'Data Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PekerjaanUmum  $pekerjaanUmum
     * @return \Illuminate\Http\Response
     */
    public function show(PekerjaanUmum $pekerjaanUmum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PekerjaanUmum  $pekerjaanUmum
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if ($id === "") {
            return view('admin/404');
        } else {
            $pekerjaanUmums = DB::table('pekerjaan_umums')
                ->where('pekerjaan_umums.id', $id)
                ->get();
            if ($pekerjaanUmums != null) {
                return view('admin/pekerjaanUmum/edit', ['pekerjaanUmums' => $pekerjaanUmums]);
            } else {
                return view('admin/404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PekerjaanUmum  $pekerjaanUmum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([

            'tahun' => 'required',
            'sumber_dana' => 'required',
            'jumlah_dana' => 'required',
        ]);

        $pekerjaanUmum = PekerjaanUmum::find($id);
        $pekerjaanUmum->tahun = $request->tahun;
        $pekerjaanUmum->sumber_dana = $request->sumber_dana;
        $pekerjaanUmum->jumlah_dana = $request->jumlah_dana;
        $pekerjaanUmum->save();
        return redirect('admin/pekerjaanUmum')->with('status', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PekerjaanUmum  $pekerjaanUmum
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $pekerjaanUmum = PekerjaanUmum::find($id);
        $pekerjaanUmum->delete();
        return redirect('admin/pekerjaanUmum')->with('status', 'Data Berhasil Dihapus');
    }
    public function cd_pekerjaanUmum()
    {
        return view('admin/pekerjaanUmum/pekerjaanUmum_tambah');
    }
    public function export_excell()
    {
        $nama = "PekerjaanUmum" . date('d-F-Y');
        return Excel::download(new PekerjaanUmumExport, $nama . '.xlsx');
    }

    public function import_excell(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // import data
        Excel::import(new PekerjaanUmumImport, request()->file('file'));

        // alihkan halaman kembali
        return redirect('admin/pekerjaanUmum')->with('status', 'Data Berhasil Ditambahkan');
    }

    public function dasboard_pekerjaanUmum()
    {
        return view('Admin/pekerjaanUmum/dasboard');
    }

    public function getDataChart()
    {
        $pekerjaanUmum = PekerjaanUmum::all();
        return json_encode($pekerjaanUmum);
    }
}
