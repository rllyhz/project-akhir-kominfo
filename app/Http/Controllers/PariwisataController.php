<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Pariwisata;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exports\PariwisataExport;
use App\Imports\PariwisataImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DataTables;

class PariwisataController extends Controller
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
            $data = Pariwisata::all();
            
            return DataTables::of($data)
                    ->addColumn('action',function($row){
                        $btn ='<a href="pariwisata/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a>';
                        $btn  .='<form action="pariwisata/'.$row->id.'" method="post" style="display:inline;">
                        <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin hapus ?\')"><i class="fas fa-trash"></i> Delete</button></form>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin/pariwisata/index');
        //
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
            'tahun'=>'required',
            'nama_wisata'=>'required',
            'jumlah_wisatawan'=>'required',
        ]);
        $pariwisata = new Pariwisata;
        $pariwisata->tahun = $request->tahun;
        $pariwisata->nama_wisata = $request->nama_wisata;
        $pariwisata->jumlah_wisatawan = $request->jumlah_wisatawan;
        $pariwisata->save();
        return redirect('admin/pariwisata')->with('status','Data Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pariwisata  $pariwisata
     * @return \Illuminate\Http\Response
     */
    public function show(Pariwisata $pariwisata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pariwisata  $pariwisata
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if($id ===""){
            return view('admin/404');
        }else{
            $pariwisatas = DB::table('pariwisatas')
                            ->where('pariwisatas.id',$id)
                            ->get();
            if($pariwisatas != null){
                return view('admin/pariwisata/edit',['pariwisatas'=>$pariwisatas]);
            }else{
                return view('admin/404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pariwisata  $pariwisata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            
            'tahun'=>'required',
            'nama_wisata'=>'required',
            'jumlah_wisatawan'=>'required',
        ]);

        $pariwisata = Pariwisata::find($id);
        $pariwisata->tahun = $request->tahun;
        $pariwisata->nama_wisata = $request->nama_wisata;
        $pariwisata->jumlah_wisatawan = $request->jumlah_wisatawan;
        $pariwisata->save();
        return redirect('admin/pariwisata')->with('status','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pariwisata  $pariwisata
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $pariwisata = Pariwisata::find($id);
        $pariwisata->delete();
        return redirect('admin/pariwisata')->with('status','Data Berhasil Dihapus');
    }
    public function cd_pariwisata(){
        return view('admin/pariwisata/pariwisata_tambah');
    }
    public function export_excell(){
        $nama = "Pariwisata".date('d-F-Y');
        return Excel::download(new PariwisataExport ,$nama.'.xlsx');
    }

    public function import_excell(Request $request){
        		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		
		// import data
		Excel::import(new PariwisataImport, request()->file('file'));
 
		
 
		// alihkan halaman kembali
		return redirect('admin/pariwisata')->with('status','Data Berhasil Ditambahkan');
    }


    public function dasboard_pariwisata(){
        return view('Admin/pariwisata/dasboard');
    }
    public function getDataChart(){
        $pariwisata = DB::table('pariwisatas')
        ->get();
        dd($pariwisata);
        return json_encode($pariwisata);
    }
}
