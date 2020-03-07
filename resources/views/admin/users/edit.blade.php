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
                        <form action="{{ route('admin.manage.users.update', $user->id) }}" method="POST">
                            @csrf @method('put')
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Anda tidak diperbolehkan mengganti password user" readonly>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="custom-select" required>
                                    <option value="">--pilih--</option>
                                    @foreach ($roles as $item)
                                    <option @if($user->role_id === $item->id) selected @else "" @endif value="{{ $item->id }}">{{ $item->nama_role }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="container mt-4">
                                <button class="btn btn-success btn-sm mr-2">Simpan</button>
                                <a href="{{ route('admin.manage.users.index') }}" class="btn btn-light btn-sm">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection

@section('modal-section')
@endsection


@section('css')
@endsection


@section('scripts')
<script></script>
@endsection