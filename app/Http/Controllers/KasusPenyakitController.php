<?php

namespace App\Http\Controllers;

use App\Imports\PenyakitImport;
use App\KasusPenyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class KasusPenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penyakit = KasusPenyakit::with('penyakit')->get();

        $total_penyakit = 0;
        foreach ($penyakit as $item) {
            $total_penyakit += intval($item->jumlah);
        }

        return view('admin.penyakit.index', [
            'penyakit' => $penyakit,
            'total_penyakit' => $total_penyakit,
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
        $this->validate($request, [
            'tahun' => ['integer', 'digits:4', 'required', 'min:1900', 'max:' . (date('Y') + 1)],
            'jenis_penyakit' => ['max:255', 'required'],
            'jumlah' => ['required', 'integer'],
        ]);

        KasusPenyakit::create([
            'tahun' => $request->tahun,
            'jenis_penyakit' => $request->jenis_penyakit,
            'jumlah' => $request->jumlah
        ]);

        return redirect()->route('admin.penyakit.index')->with('info', [
            'status' => 'success',
            'pesan' => 'Data penyakit berhasil disimpan!',
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
        $penyakit = KasusPenyakit::findOrFail($id);
        return view('admin.penyakit.edit', compact('penyakit'));
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
        $max = 'max:' . (intval(date('Y')) + 2000);
        $this->validate($request, [
            'tahun' => ['integer', 'digits:4', 'required', 'min:1900', $max],
            'jenis_penyakit' => ['max:255', 'required'],
            'jumlah' => ['required', 'integer'],
        ]);
        $penyakit = KasusPenyakit::findOrFail($id);

        $penyakit->tahun = $request->tahun;
        $penyakit->jenis_penyakit = $request->jenis_penyakit;
        $penyakit->jumlah = $request->jumlah;

        if ($penyakit->save()) {
            return redirect()->route('admin.penyakit.index')->with('info', [
                'status' => 'success',
                'pesan' => 'Berhasil mengedit data penyakit!',
            ]);
        } else {
            return redirect()->route('admin.penyakit.index')->with('info', [
                'status' => 'danger',
                'pesan' => 'Gagal mengedit data penyakit!',
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
        $penyakit = KasusPenyakit::findOrFail($id);

        if ($penyakit->delete()) {
            return redirect()->route('admin.penyakit.index')->with('info', [
                'status' => 'success',
                'pesan' => 'Berhasil menghapus data penyakit!',
            ]);
        } else {
            return redirect()->route('admin.penyakit.index')->with('info', [
                'status' => 'success',
                'pesan' => 'Berhasil menghapus data penyakit!',
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
            return redirect()->route('admin.penyakit.index')->with('info', [
                'status' => 'danger',
                'pesan' => 'Maaf.. File yang anda upload bukan file excel. Silahkan upload file dengan extension <strong>xls</strong> atau <strong>xlsx</strong>!',
            ]);
        }

        if ($file->getSize() > 1000000) {
            return redirect()->route('admin.penyakit.index')->with('info', [
                'status' => 'danger',
                'pesan' => 'Maaf.. File yang anda upload melebihi ukuran maksimal. Maksimal file kurang dari 10mb <strong>xlx</strong> atau <strong>xlxs</strong>!',
            ]);
        }

        if (Excel::import(new PenyakitImport, $file->getRealPath())) {
            $nama_file_baru = time() . '_' . $file->getClientOriginalName();
            $file->move('file_excel/data_penyakit', $nama_file_baru);

            $file_import = 'file_excel' . DIRECTORY_SEPARATOR . 'data_penyakit' . DIRECTORY_SEPARATOR . $nama_file_baru;

            if (File::delete($file_import)) {
                return redirect()->route('admin.penyakit.index')->with('info', [
                    'status' => 'success',
                    'pesan' => 'Berhasil mengimport file ' . $file->getClientOriginalName() . '!',
                ]);
            } else {
                return redirect()->route('admin.penyakit.index')->with('info', [
                    'status' => 'success',
                    'pesan' => 'Berhasil mengimport file ' . $file->getClientOriginalName() . '. Gagal menghapus file!',
                ]);
            }
        } else {
            return redirect()->route('admin.penyakit.index')->with('info', [
                'status' => 'danger',
                'pesan' => 'Gagal mengimport file ' . $file->getClientOriginalName() . '!',
            ]);
        }
    }

    public function export()
    {
    }

    public function getDataChart()
    {
        $penyakit = KasusPenyakit::with('penyakit')->get();

        dd($penyakit);

        $penyakitFix = [];

        for ($i = 0; $i < $penyakit->count(); $i++) {
            $penyakitFix[$i] = [
                "id" => $penyakit[$i]->id,
                "kecamatan" => $penyakit[$i]->kecamatan->nama_kecamatan,
                "tahun" => $penyakit[$i]->tahun,
                "jenis_penyakit" => $penyakit[$i]->jenis_penyakit,
                "jumlah" => $penyakit[$i]->jumlah,
            ];
        }

        dd($penyakitFix);

        $total_penyakit = 0;
        foreach ($penyakit as $item) {
            $total_penyakit += intval($item->jumlah);
        }

        $GLOBALS['tahun'] = [];
        $GLOBALS['jenis_penyakit'] = [];
        $GLOBALS['tahunSebelumnya'] = null;
        $GLOBALS['penyakitSebelumnya'] = null;

        $penyakitFix->map(function ($penyakitFix) {
            if (intval($penyakitFix->tahun) !== intval($GLOBALS['tahunSebelumnya'])) {
                // echo 'ga sama <br>';
                if (!in_array($penyakitFix->tahun, $GLOBALS['tahun'])) {
                    array_push($GLOBALS['tahun'], $penyakitFix->tahun);
                }
                $GLOBALS['tahunSebelumnya'] = $penyakitFix->tahun;
            } else {
                // echo 'sama nih <br>';
                $GLOBALS['tahunSebelumnya'] = $penyakitFix->tahun;
            }
        });

        $penyakitFix->map(function ($kasus) {
            if ($kasus->jenis_penyakit !== $GLOBALS['penyakitSebelumnya']) {
                // echo 'ga sama <br>';
                if (!in_array($kasus->jenis_penyakit, $GLOBALS['jenis_penyakit'])) {
                    array_push($GLOBALS['jenis_penyakit'], $kasus->jenis_penyakit);
                }
                $GLOBALS['penyakitSebelumnya'] = $kasus->jenis_penyakit;
            } else {
                // echo 'sama nih <br>';
                $GLOBALS['penyakitSebelumnya'] = $kasus->jenis_penyakit;
            }
        });

        $tahun = $GLOBALS['tahun'];
        $nama_penyakit = $GLOBALS['jenis_penyakit'];

        foreach ($tahun as $th) {
            $dataPerTahun[$th] = [];
        }

        foreach ($tahun as $th) {
            foreach ($penyakitFix as $p) {
                if ($p->tahun == $th) {
                    array_push($dataPerTahun[$th], $p);
                }
            }
        }

        $data = [
            'penyakit' => $penyakitFix,
            'tahun' => $tahun,
            'nama_penyakit' => $nama_penyakit,
            'dataPerTahun' => $dataPerTahun,
            'total_penyakit' => $total_penyakit,
        ];

        echo json_encode($data);
    }
}
