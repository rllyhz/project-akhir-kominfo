<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\PenanggulanganBencana;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exports\PenanggulanganBencanaExport;
use App\Imports\PenanggulanganBencanaImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DataTables;

class PenanggulanganBencanaController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = PenanggulanganBencana::all();
          
            return DataTables::of($data)
                    
                    ->addColumn('action',function($row){
                        $btn ='<a href="penanggulanganBencana/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a>';
                        $btn  .='<form action="penanggulanganBencana/'.$row->id.'" method="post" style="display:inline;">
                        <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin hapus ?\')"><i class="fas fa-trash"></i> Delete</button></form>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin/penanggulanganBencana/index');
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
        // dd($_POST);
        $request->validate([
            'tahun'=>'required',
            'penyebab'=>'required',
            'tempat_kebakaran'=>'required',
            'jumlah'=>'required',
        ]);
        $penanggulanganBencana = new PenanggulanganBencana;
        $penanggulanganBencana->tahun = $request->tahun;
        $penanggulanganBencana->penyebab = $request->penyebab;
        $penanggulanganBencana->tempat_kebakaran = $request->tempat_kebakaran;
        $penanggulanganBencana->jumlah = $request->jumlah;
        $penanggulanganBencana->save();
        return redirect('admin/penanggulanganBencana')->with('status','Data Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PenanggulanganBencana  $penanggulanganBencana
     * @return \Illuminate\Http\Response
     */
    public function show(PenanggulanganBencana $penanggulanganBencana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PenanggulanganBencana  $penanggulanganBencana
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if($id ===""){
            return view('admin/404');
        }else{
            $penanggulanganBencanas = DB::table('penanggulangan_bencanas')
                            ->where('penanggulangan_bencanas.id',$id)
                            ->get();
                            // dd($penanggulanganBencanas);
            if($penanggulanganBencanas != null){
                return view('admin/penanggulanganBencana/edit',['penanggulanganBencanas'=>$penanggulanganBencanas]);
            }else{
                return view('admin/404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PenanggulanganBencana  $penanggulanganBencana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'tahun'=>'required',
            'penyebab'=>'required',
            'tempat_kebakaran'=>'required',
            'jumlah'=>'required',
        ]);
        $penanggulanganBencana =PenanggulanganBencana::find($id);
        $penanggulanganBencana->tahun = $request->tahun;
        $penanggulanganBencana->penyebab = $request->penyebab;
        $penanggulanganBencana->tempat_kebakaran = $request->tempat_kebakaran;
        $penanggulanganBencana->jumlah = $request->jumlah;
        $penanggulanganBencana->save();
        return redirect('admin/penanggulanganBencana')->with('status','Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PenanggulanganBencana  $penanggulanganBencana
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $penanggulanganBencana = PenanggulanganBencana::find($id);
        $penanggulanganBencana->delete();
        return redirect('admin/penanggulanganBencana')->with('status','Data Berhasil Dihapus');
    }
    public function cd_penanggulangan_bencana(){
        return view('admin/penanggulanganBencana/penanggulangan_bencana_tambah');
    }
    public function export_excell(){
        $nama = "PenanggulanganBencana".date('d-F-Y');
        return Excel::download(new PenanggulanganBencanaExport ,$nama.'.xlsx');
    }

    public function import_excell(Request $request){
        		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		
		// import data
		Excel::import(new PenanggulanganBencanaImport, request()->file('file'));
 
 
		// alihkan halaman kembali
		return redirect('admin/penanggulanganBencana')->with('status','Data Berhasil Ditambahkan');
    }

    public function dasboard_penanggulanganBencana(){
        return view('Admin/penanggulanganBencana/dasboard');
    }

    public function getDataChart(){
        $penanggulanganBencana = PenanggulanganBencana::all();
        return json_encode($penanggulanganBencana);
    }
}
