@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Halaman Edit Profile</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('profile.update') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-10 mx-auto my-0">
                            <div class="mb-2 px-0">
                                <i>Kamu hanya diperbolehkan mengganti field nama.</i>
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" placeholder="Hadi Saputra" name="nama" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10 mx-auto my-1">
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                            <a href="{{ route('profile.index') }}" class="btn btn-sm btn-light">Batal</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
