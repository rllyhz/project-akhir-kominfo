@extends('layouts.admin.app')

@section('title', 'Kelola Users')

@section('page-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark mr\\">Halaman Kelola Users</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Users</li>
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

<div class="row">
  <div class="col-sm">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <h3 class="card-title mb-3">Tabel Users</h3>
                    </div>
                </div>
                {{-- <div class="row mb-3">
                    <button href="" class="btn btn-primary btn-sm ml-2" data-toggle="modal" data-target="#tambah_data_user">
                        Tambah User Baru
                    </button>
                </div> --}}
                <div class="row">
                    <div class="col-sm">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Nama</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Role</th>
                                  <th scope="col" class="text-center">Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $index = 0; ?>
                                @foreach ($users as $item)
                                <tr>
                                    <th scope="row">{{ ++$index }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $roles[($item->role_id - 1)]->nama_role }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.manage.users.edit', $item->id) }}" class="btn btn-warning badge">Edit</a>
                                        <form action="{{ route('admin.manage.users.destroy', $item['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class='btn btn-danger badge' onclick="return confirm('Yakin ingin menghapus?')" type="submit">Hapus</button>
                                          </form>
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection

@section('modal-section')
<!-- Modal Tambah Data User -->
<div class="modal fade" id="tambah_data_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah User Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.manage.users.store') }}" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" class="custom-select" required>
                    <option>--- pilih ---</option>
                    @foreach ($roles as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_role }}</option>
                    @endforeach
                </select>
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection


@section('css')
@endsection


@section('scripts')
<script></script>
@endsection