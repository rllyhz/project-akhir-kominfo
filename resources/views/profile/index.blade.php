@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Halaman Profile</h4>
                </div>

                <div class="card-body">
                    @if (session('info'))
                    <div class="alert alert-{{ session('info')['status'] }} alert-dismissible fade show" role="alert">
                        {!! session('info')['pesan'] !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-10 mx-auto my-0">
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <tr>
                                        <td><strong>Nama :</strong></td>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email :</strong></td>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Role :</strong></td>
                                        <td>{{ $roles[(Auth::user()->role_id - 1)]->nama_role }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Password :</strong></td>
                                        <td><i>Sesuai yang telah anda tentukan.</i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-10 mx-auto my-1">
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-dark mr-2">Edit Profile</a>
                            <a href="#" class="btn btn-sm btn-dark">Ganti Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
