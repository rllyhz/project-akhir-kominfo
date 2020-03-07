@extends('layouts.admin.app')

@section('page-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark mr\\">Halaman Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row mb-1">
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
                    <div class="container">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        <div class="container">
            <div class="card py-2 text-center">
                <i class="nav-icon fas fa-users fa-4x" style="color: #ababab;"></i>
                <div class="card-body">
                  <h5 class="text-center mb-2 font-weight-bold">Total Users</h5>
                  <h4 class="card-text font-weight-bold">34</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="container">
            <div class="card py-2 text-center">
                <i class="nav-icon fas fa-database fa-4x" style="color: #ababab;"></i>
                <div class="card-body">
                  <h5 class="text-center mb-2 font-weight-bold">Total Datasets</h5>
                  <h4 class="card-text font-weight-bold">7</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="container">
            <div class="card py-2 text-center">
                <i class="nav-icon fas fa-chart-pie fa-4x" style="color: #ababab;"></i>
                <div class="card-body">
                  <h5 class="text-center mb-2 font-weight-bold">Total Users</h5>
                  <h4 class="card-text font-weight-bold">34</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="container">
            <div class="card py-2 text-center">
                <i class="nav-icon fas fa-chart-bar fa-4x" style="color: #ababab;"></i>
                <div class="card-body">
                  <h5 class="text-center mb-2 font-weight-bold">Total Users</h5>
                  <h4 class="card-text font-weight-bold">34</h4>
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection