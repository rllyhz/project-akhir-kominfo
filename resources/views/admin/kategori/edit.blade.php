@extends('layouts.admin.app')

@section('title', 'Data Kategori')

@section('page-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Halaman Kategori</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Kategori</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row">
    <div class="col-sm">
        <form action="{{ route('admin.manage.kategori.update', $kategori['id']) }}" method="POST">
            <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" required value="{{ $kategori['gambar'] }}">
                </div>
                <div class="form-group">
                <label for="jenis_kategori">Jenis Kategori</label>
                <select name="jenis_kategori" class="custom-select" required>
                    @foreach ($semuaKategori as $item)
                        <option {{ $kategori['jenis_kategori'] == $item->jenis_kategori ? 'selected' : '' }} value="{{ $item->jenis_kategori }}">{{ $item->jenis_kategori }}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                <label for="jumlah">Jumlah kategori</label>
                <input type="number" class="form-control" id="jumlah" name="jumlahkategori" value="{{ $kategori['jumlah'] }}">
                </div>

                <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-dark">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection