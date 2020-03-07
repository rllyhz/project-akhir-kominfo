@extends('layouts.admin.app')
@section('title','Form Update Data')

@section('content')
<div class="container ml-5">
    <div class="row">
        <div class="col-md-8">
        @foreach($kependudukans as $kependudukan)
        
                @endforeach
        
        <form action="{{route('admin.kependudukan.update',$kependudukan->id)}}" method="post">
                @csrf
                @method("put")
            <h2>Form Edit Data Siswa Putus Sekolah</h2>
            
            <div class="form-group">
                <label for="kecamatan">Pilih Kecamatan</label>
                <select id="kecamatan" class="form-control" name="kecamatan">
                @foreach($kecamatans as $kecamatan)
                    <option value="{{$kecamatan->id}}" {{($kecamatan->id == $kependudukan->kecamatan_id)?'selected':''}}>{{$kecamatan->nama_kecamatan}}</option>
                @endforeach
                </select>
                
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select id="tahun" class="form-control" name="tahun">
                    
                    @for($i=0;$i<10;$i++)
                    <option value="{{date('Y')-5+$i}}" {{($kependudukan->tahun== date('Y')-5+$i) ? 'selected':''}}>{{date('Y')-5+$i }}</option>

                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" class="form-control" name="status">
                <option value="none">Pilih...</option>
                    <option value="Kelahiran" @if($kependudukan->status =="Kelahiran") selected @else "" @endif>Kelahiran</option>
                    <option value="Kematian" @if($kependudukan->status =="Kematian") selected @else "" @endif>Kematian</option>
                    <option value="Usia 0-11" @if($kependudukan->status =="Usia 0-11") selected @else "" @endif>Usia 0-11</option>
                    <option value="Usia 12-25" @if($kependudukan->status =="Usia 12-25") selected @else "" @endif>Usia 12-25</option>
                    <option value="Usia  26-45" @if($kependudukan->status =="Usia  26-45") selected @else "" @endif>Usia  26-45</option>
                    <option value="Usia Lansia" @if($kependudukan->status =="Usia Lansia") selected @else "" @endif>Usia Lansia</option>

                  
                </select>
            </div>
          
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" placeholder="Jumlah" name="jumlah" value="{{$kependudukan->jumlah}}"> orang
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
</div>


@endsection