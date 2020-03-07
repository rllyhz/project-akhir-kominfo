@extends('layouts.admin.app')
@section('title','Form Update Data')

@section('content')
<div class="container ml-5">
    <div class="row">
        <div class="col-md-8">
        @foreach($lingkunganHidups as $lingkunganHidup)
                @endforeach
        
        <form action="{{route('admin.lingkunganHidup.update',$lingkunganHidup->id)}}" method="post">
                @csrf
                @method("put")
            <h2>Form Edit Data Lingkungan Hidup</h2>
            
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select id="tahun" class="form-control" name="tahun">
                    
                    @for($i=0;$i<10;$i++)
                    <option value="{{date('Y')-5+$i}}" {{($lingkunganHidup->tahun== date('Y')-5+$i) ? 'selected':''}}>{{date('Y')-5+$i }}</option>

                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="jenis_rumah">jenis_rumah</label>
                <select id="jenis_rumah" class="form-control" name="jenis_rumah">
                <option value="">Pilih...</option>
                    <option value="Rumah Tempat Tinggal"  @if($lingkunganHidup->jenis_rumah =="Rumah Tempat Tinggal") selected @else "" @endif >Rumah Tempat Tinggal</option>
                    <option value="Tempat Peribadatan" @if($lingkunganHidup->jenis_rumah =="Tempat Peribadatan") selected @else "" @endif >Tempat Peribadatan</option>
                    <option value="Instansi Pemerintahan" @if($lingkunganHidup->jenis_rumah =="Instansi Pemerintahan") selected @else "" @endif >Instansi Pemerintahan</option>
                    <option value="Hotel" @if($lingkunganHidup->jenis_rumah =="Hotel") selected @else "" @endif >Hotel</option>
                    <option value="Sarana Umum" @if($lingkunganHidup->jenis_rumah =="Sarana Umum") selected @else "" @endif >Sarana Umum</option>
                    <option value="Badan Sosial dan Rumah Sakit" @if($lingkunganHidup->jenis_rumah =="Badan Sosial dan Rumah Sakit") selected @else "" @endif >Badan Sosial dan Rumah Sakit</option>
                    <option value="Perusahaan, Toko, Industri" @if($lingkunganHidup->jenis_rumah =="Perusahaan, Toko, Industri") selected @else "" @endif >Perusahaan, Toko, Industri</option>
                    <option value="Lain-lain" @if($lingkunganHidup->jenis_rumah =="Lain-lain") selected @else "" @endif >Lain-lain</option>
                </select>
            </div>
          
            <div class="form-group">
                <label for="debit_air">Debit Air</label>
                <input type="number" class="form-control" id="debit_air" placeholder="debit_air" name="debit_air" value="{{$lingkunganHidup->debit_air}}"> 
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
</div>


@endsection