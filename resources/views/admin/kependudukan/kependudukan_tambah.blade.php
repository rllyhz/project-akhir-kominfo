@extends('layouts.admin.app')
@section('title','Form Input Data')

@section('content')
<div class="container ml-5">
    <div class="row">
        <div class="col-md-8">
        <form action="{{ route('admin.kependudukan.store')}}" method="post">
                @csrf
                @method("post")
            <h2>Form Input Data Kependudukan Warga Kota Semarang</h2>
            <div class="form-group">
                <label for="kecamatan">Pilih Kecamatan</label>
                <select id="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" required>
                    <option value="">Pilih</option>
                    @foreach($kecamatans as $kecamatan)
                    <option value="{{$kecamatan->id}}">{{$kecamatan->nama_kecamatan}}</option>
                    @endforeach
                    @error('kecamatan')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </select>
               
            </div>
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
                <label for="status">Status</label>
                <select id="status" class="form-control" name="status" required>
                <option value="">Pilih...</option>
                    <option value="Kelahiran" >Kelahiran</option>
                    <option value="Kematian" >Kematian</option>
                    <option value="Usia 0-11" >Usia 0-11</option>
                    <option value="Usia 12-25" >Usia 12-25</option>
                    <option value="Usia  26-45" >Usia  26-45</option>
                    <option value="Usia Lansia" >Usia Lansia</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" placeholder="Jumlah" name="jumlah"> orang
                @error('jumlah')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
</div>


@endsection