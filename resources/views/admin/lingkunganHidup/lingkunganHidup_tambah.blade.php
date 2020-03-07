@extends('layouts.admin.app')
@section('title','Form Input Data')

@section('content')
<div class="container ml-5">
    <div class="row">
        <div class="col-md-8">
        <form action="{{ route('admin.lingkunganHidup.store')}}" method="post">
                @csrf
                @method("post")
            <h2>Form Input Data Lingkungan Hidup Kota Semarang</h2>
            
            
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
                <label for="jenis_rumah">Jenis Rumah</label>
                <select id="jenis_rumah" class="form-control" name="jenis_rumah" required>
                <option value="">Pilih...</option>
                    <option value="Rumah Tempat Tinggal" >Rumah Tempat Tinggal</option>
                    <option value="Tempat Peribadatan" >Tempat Peribadatan</option>
                    <option value="Instansi Pemerintahan" >Instansi Pemerintahan</option>
                    <option value="Hotel" >Hotel</option>
                    <option value="Sarana Umum" >Sarana Umum</option>
                    <option value="Badan Sosial dan Rumah Sakit" >Badan Sosial dan Rumah Sakit</option>
                    <option value="Perusahaan, Toko, Industri" >Perusahaan, Toko, Industri</option>
                    <option value="Lain-lain" >Lain-lain</option>
                </select>
            </div>
            <div class="form-group">
                <label for="debit_air">Debit Air</label>
                <input type="text" class="form-control @error('debit_air') is-invalid @enderror" id="debit_air" placeholder="debit air" name="debit_air"> 
                @error('debit_air')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
</div>


@endsection