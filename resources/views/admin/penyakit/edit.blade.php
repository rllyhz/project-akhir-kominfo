@extends('layouts.admin.app')

@section('title', 'Data Penyakit')

@section('page-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Halaman Kesehatan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Penyakit</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
        <form action="{{ route('admin.penyakit.update', $penyakit['id']) }}" method="POST">
            <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="number" class="form-control" id="tahun" name="tahun" required value="{{ $penyakit['tahun'] }}">
                </div>
                <div class="form-group">
                <label for="jenis_penyakit">Jenis Penyakit</label>
                <select name="jenis_penyakit" class="custom-select" required>
                    <option {{ $penyakit['jenis_penyakit'] == "Malaria" ? 'selected' : '' }} value="Malaria">Malaria</option>
                    <option {{ $penyakit['jenis_penyakit'] == "Gastro Enteritis" ? 'selected' : '' }} value="Gastro Enteritis">Gastro Enteritis</option>
                    <option {{ $penyakit['jenis_penyakit'] == "Kholera/Cholera" ? 'selected' : '' }} value="Kholera/Cholera">Kholera/Cholera</option>
                    <option {{ $penyakit['jenis_penyakit'] == "Kusta/Leprosy" ? 'selected' : '' }} value="Kusta/Leprosy">Kusta/Leprosy</option>
                    <option {{ $penyakit['jenis_penyakit'] == "TBC/Tuberculosis" ? 'selected' : '' }} value="TBC/Tuberculosis">TBC/Tuberculosis</option>
                    <option {{ $penyakit['jenis_penyakit'] == "Demam Berdarah DHF" ? 'selected' : '' }} value="Demam Berdarah DHF">Demam Berdarah DHF</option>
                    <option {{ $penyakit['jenis_penyakit'] == "Radang Tenggorokan Dipteria" ? 'selected' : '' }} value="Radang Tenggorokan Dipteria">Radang Tenggorokan Dipteria</option>
                </select>
                </div>
                <div class="form-group">
                <label for="jumlah">Jumlah Penyakit</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $penyakit['jumlah'] }}">
                </div>

                <a href="{{ route('admin.penyakit.index') }}" class="btn btn-outline-dark">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection