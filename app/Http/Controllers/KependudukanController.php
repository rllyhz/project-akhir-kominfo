<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Kependudukan;
use App\Kecamatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exports\KependudukanExport;
use App\Imports\KependudukanImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DataTables;

class KependudukanController extends Controller
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
            $data = DB::table('kecamatan')
                ->join('kependudukans', 'kecamatan.id', '=', 'kependudukans.kecamatan_id')
                ->orderBy('kependudukans.kecamatan_id', 'desc')->get();
            return DataTables::of($data)

                ->addColumn('action', function ($row) {
                    $btn = '<a href="kependudukan/' . $row->id . '/edit" class="edit btn btn-success btn-sm">Edit</a>';
                    $btn  .= '<form action="kependudukan/' . $row->id . '" method="post" style="display:inline;">
                        <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin hapus ?\')"><i class="fas fa-trash"></i> Delete</button></form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin/kependudukan/index');
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
        $request->validate([
            'kecamatan' => 'required',
            'tahun' => 'required',
            'status' => 'required',
            'jumlah' => 'required',
        ]);
        $kependudukan = new Kependudukan;
        $kependudukan->kecamatan_id = $request->kecamatan;
        $kependudukan->tahun = $request->tahun;
        $kependudukan->status = $request->status;
        $kependudukan->jumlah = $request->jumlah;
        $kependudukan->save();
        return redirect('admin/kependudukan')->with('status', 'Data Behasil Dimasukkan');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kependudukan  $kependudukan
     * @return \Illuminate\Http\Response
     */
    public function show(Kependudukan $kependudukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kependudukan  $kependudukan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id === "") {
            return redirect('/admin/kependudukan')->with('status', 'Access Denied');
        } else {
            # code...
            $kependudukans = DB::table('kecamatan')
                ->join('kependudukans', 'kecamatan.id', '=', 'kependudukans.kecamatan_id')
                ->where('kependudukans.id', $id)->get();
            $kecamatans = Kecamatan::all();
            // dd($kependudukans);
            if ($kependudukans != "") {
                # code...
                return view('/admin/kependudukan/edit', ['kependudukans' => $kependudukans, 'kecamatans' => $kecamatans]);
            } else {
                return view('/admin/404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kependudukan  $kependudukan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'kecamatan' => 'required',
            'tahun' => 'required',
            'status' => 'required',
            'jumlah' => 'required',
        ]);
        // dd($id);
        $kependudukan = Kependudukan::find($id);
        // dd($kependudukan);
        $kependudukan->kecamatan_id = $request->kecamatan;
        $kependudukan->tahun = $request->tahun;
        $kependudukan->status = $request->status;
        $kependudukan->jumlah = $request->jumlah;
        $kependudukan->save();
        return redirect('admin/kependudukan')->with('status', 'Data Behasil Di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kependudukan  $kependudukan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kependudukan = Kependudukan::find($id);
        $kependudukan->delete();
        return redirect('admin/kependudukan')->with('status', 'Data Berhasil dihapus');
    }

    public function cd_kependudukan()
    {
        $kecamatans = Kecamatan::All();
        return view('admin/kependudukan/kependudukan_tambah', ['kecamatans' => $kecamatans]);
    }

    public function export_excell()
    {
        $nama = "Kependudukan" . date('d-F-Y');
        return Excel::download(new KependudukanExport, $nama . '.xlsx');
    }

    public function import_excell(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // import data
        Excel::import(new KependudukanImport, request()->file('file'));

        // alihkan halaman kembali
        return redirect('admin/kependudukan')->with('status', 'Data Berhasil Ditambahkan');
    }

    public function dasboard_kependudukan()
    {
        return view('Admin/kependudukan/dasboard');
    }

    public function getDataChart()
    {
        $kependudukan = DB::table('kependudukans')
            ->join('kecamatan', 'kependudukans.kecamatan_id', '=', 'kecamatan.id')
            ->select('kependudukans.*', 'kecamatan.nama_kecamatan')
            ->get();

        return json_encode($kependudukan);
    }
}
