@extends('layouts.admin.app')
@section('title','Data Kependudukan')

@section('content')
        <div class="container ml-5">

            <div class="row">
                <div class="col-md-11">
                    <h1>Data Kependudukan</h1>
                    <div class="row mt-5">

            <!-- data Kependudukan -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{route('admin.kependudukan.index')}}" >
                    <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data jumlah Penduduk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                </a>
            </div>

            <!-- data lain-->
            <div class="col-xl-3 col-md-6 mb-4">
              <a href="">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data Lain</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                      </div>
                      <div class="col-auto">
                        <i class="fa fa-folder fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>

              </a>
            </div>

           
                  
                        
                </div>
                </div>
            </div>
        </div>



       
@endsection
@section('scripts')


@endsection