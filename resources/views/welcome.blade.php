@extends('layouts.app')

@section('title', "Welcome")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="container">
                <div class="row">
                    <div class="col">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Content --}}
                <div class="row">
                    <div class="col">
                        <a href="">
                            <div class="card">
                                <img src="{{ asset('images/kategori/pendidikan.png') }}" class="card-img-top" />
                                <div class="card-body">            
                                    <p class="text-center mb-0 mt-2">Data Pendidikan</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="">
                            <div class="card">
                                <img src="{{ asset('images/kategori/kependudukan.png') }}" class="card-img-top" />
                                <div class="card-body">            
                                    <p class="text-center mb-0 mt-2">Data Kependudukan</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="">
                            <div class="card">
                                <img src="{{ asset('images/kategori/keuangan.jpg') }}" class="card-img-top" />
                                <div class="card-body">            
                                    <p class="text-center mb-0 mt-2">Data Keuangan</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="">
                            <div class="card">
                                <img src="{{ asset('images/kategori/sosial.jpg') }}" class="card-img-top" />
                                <div class="card-body">            
                                    <p class="text-center mb-0 mt-2">Data Sosial</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection