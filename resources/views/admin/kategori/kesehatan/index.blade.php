@extends('layouts.admin.app')

@section('title', 'Data Kesehatan')

@section('page-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Halaman Kesehatan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Kesehatan</li>
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

<div class="row mt-5 mb-3">
  <div class="col-sm">
    <center>
      <h3>Data Kesehatan</h3>
    </center>
  </div>
</div>

<div class="row">
    <div class="col-sm">
        <a href="{{ route('admin.penyakit.index') }}">
            <div class="card">
                <div class="card-body">
                    <center>
                        <h5 class="title-card">Data Kasus Penyakit Menular</h5>
                    </center>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm">
        <a href="">
            <div class="card">
                <div class="card-body">
                    <center>
                        <h5 class="title-card">Data Lain</h5>
                    </center>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm">
        <a href="">
            <div class="card">
                <div class="card-body">
                    <center>
                        <h5 class="title-card">Data Lain</h5>
                    </center>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection

@section('modal-section')
@endsection


@section('scripts')
@endsection