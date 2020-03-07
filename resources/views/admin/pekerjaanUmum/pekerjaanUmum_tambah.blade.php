@extends('layouts.admin.app')
@section('title','Form Input Data')

@section('content')
<div class="container ml-5">
    <div class="row">
        <div class="col-md-8">
        <form action="{{ route('admin.pekerjaanUmum.store')}}" method="post">
                @csrf
                @method("post")
            <h2>Form Input Anggaran Konstruksi Kota Semarang</h2>

            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select id="tahun" class="form-control" name="tahun" required>
                    <option value="">Pilih...</option>
                    @for($i=0;$i<10;$i++)
                    <option value="{{date('Y')-5+$i}}">{{date('Y')-5+$i}}</option>

                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="sumber_dana">Sumber Dana</label>
                <select id="sumber_dana" class="form-control" name="sumber_dana">
                <option value="">Pilih...</option>
                    <option value="APBN"  >APBN</option>
                    <option value="APBD"  >APBD</option>
                    <option value="Luar Negeri">Luar Negeri</option>
                    <option value="Sumber dana Lainya" >Sumber dana Lainya</option>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_dana">Jumlah Dana</label>
                <input type="text" class="form-control @error('jumlah_dana') is-invalid @enderror" id="jumlah_dana" placeholder="1000000" name="jumlah_dana"> 
                @error('jumlah_dana')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
</div>


@endsection