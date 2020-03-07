<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\LingkunganHidup;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exports\LingkunganHidupExport;
use App\Imports\LingkunganHidupImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DataTables;

class LingkunganHidupController extends Controller
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
            $data = LingkunganHidup::all();
            return DataTables::of($data)
                    
                    ->addColumn('action',function($row){
                        $btn ='<a href="lingkunganHidup/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a>';
                        $btn  .='<form action="lingkunganHidup/'.$row->id.'" method="post" style="display:inline;">
                        <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin hapus ?\')"><i class="fas fa-trash"></i> Delete</button></form>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin/lingkunganHidup/index');
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
            'jenis_rumah' => 'required',
            'debit_air' => 'required',
        ]);

        $lingkunganHidup = new LingkunganHidup;
        $lingkunganHidup->tahun = $request->tahun;
        $lingkunganHidup->jenis_rumah = $request->jenis_rumah;
        $lingkunganHidup->debit_air = $request->debit_air;
        $lingkunganHidup->save();
        return redirect('admin/lingkunganHidup')->with('status','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LingkunganHidup  $lingkunganHidup
     * @return \Illuminate\Http\Response
     */
    public function show(LingkunganHidup $lingkunganHidup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LingkunganHidup  $lingkunganHidup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if ($id ==="") {
            return redirect('/admin/lingkunganHidup')->with('status','Access Denied');
        }else{
            # code...
            $lingkunganHidups = DB::table('lingkungan_hidups')
                        ->where('lingkungan_hidups.id',$id)->get();
            // dd($lingkungans);
            if ($lingkunganHidups!="") {
                # code...
                return view('/admin/lingkunganHidup/edit',['lingkunganHidups'=>$lingkunganHidups]);
            }
            else{
                return view('/admin/404');

            }
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LingkunganHidup  $lingkunganHidup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $request->validate([
            
            'tahun' => 'required',
            'jenis_rumah' => 'required',
            'debit_air' => 'required',
        ]);
        $lingkunganHidup = LingkunganHidup::find($id);
        $lingkunganHidup->tahun = $request->tahun;
        $lingkunganHidup->jenis_rumah = $request->jenis_rumah;
        $lingkunganHidup->debit_air = $request->debit_air;
        $lingkunganHidup->save();
        return redirect('admin/lingkunganHidup')->with('status','Data Berhasil DiUbah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LingkunganHidup  $lingkunganHidup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $lingkunganHidup = LingkunganHidup::find($id);
        $lingkunganHidup->delete();
        return redirect('admin/lingkunganHidup')->with('status','Data Berhasil dihapus');
    }

    public function cd_lingkunganHidup(){
       
        return view('admin/lingkunganHidup/lingkunganHidup_tambah');
    }
    public function export_excell(){
        $nama = "LingkunganHidup".date('d-F-Y');
        return Excel::download(new LingkunganHidupExport ,$nama.'.xlsx');
    }

    public function import_excell(Request $request){
        		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		
 
		// import data
		Excel::import(new LingkunganHidupImport, request()->file('file'));
 
		
 
		// alihkan halaman kembali
		return redirect('admin/lingkunganHidup')->with('status','Data Berhasil Ditambahkan');
    }

    public function dasboard_lingkunganHidup(){
        return view('Admin/lingkunganHidup/dasboard');
    }

    // return  data
    public function getDataChart(){
        $lingkunganHidup = LingkuganHidup::all();
        dd($lingkunganHidup);
        return json_encode($lingkunganHidup);
    }

}
