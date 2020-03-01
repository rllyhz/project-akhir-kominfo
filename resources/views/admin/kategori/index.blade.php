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
<div class="row mt-3">
  <div class="col-sm">
    @if (session('info'))
      <div class="alert alert-{{ session('info')['status'] }} alert-dismissible fade show" role="alert">
        {!! session('info')['pesan'] !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
  </div>
</div>

<div class="row mt-5">
  <div class="col-sm">
    <center>
      <h3>Data Kategori</h3>
    </center>
  </div>
</div>
<div class="row mt-3">
    <div class="col-sm-3">
        <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#data_penyakit">
        Tambah Kategori
      </button>
    </div>
</div>

<div class="row">
    <div class="col-sm">
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped table-sm table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Gambar: activate to sort column descending">Gambar</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Jenis Kategori: activate to sort column ascending">Jenis Kategori</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Deskripsi: activate to sort column ascending">Deskripsi</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $item)
                        <tr role="row">
                            <td class="sorting_1">{{ $item['gambar'] }}</td>
                            <td class="">{{ $item['jenis_kategori'] }}</td>
                            <td class="">{{ $item['deskripsi'] }}</td>
                            <td>
                              <a href="{{ route('admin.penyakit.edit', $item['id']) }}" class="badge badge-success">Edit</a>                              
                              <form action="{{ route('admin.penyakit.destroy', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class='btn btn-danger badge' onclick="return confirm('Yakin ingin menghapus?')" type="submit">Hapus</button>
                              </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th rowspan="1" colspan="1">Gambar</th>
                        <th rowspan="1" colspan="1">Jenis Kategori</th>
                        <th rowspan="1" colspan="1">Deskripsi</th>
                        <th rowspan="1" colspan="1">Aksi</th>
                    </tr>
                </tfoot>
              </table>
        </div>
    </div>
</div>
@endsection

@section('modal-section')
<!-- Modal Tambah Kategori -->
<div class="modal fade" id="data_penyakit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.manage.kategori.store') }}" method="POST">
          <div class="modal-body">
              @csrf
              <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" required>
              </div>
              <div class="form-group">
                <label for="jenis_kategori">Jenis Kategori</label>
                <input type="text" class="form-control" id="jenis_kategori" name="jenis_kategori" required>
              </div>
              <div class="form-group">
                <label for="deskripsi"></label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection


@section('scripts')

@endsection