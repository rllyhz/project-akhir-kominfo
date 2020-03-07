@extends('layouts.admin.app')
@section('title','Form Update Data')

@section('content')
<div class="container ml-5">
    <div class="row">
        <div class="col-md-8">
        @foreach($pekerjaanUmums as $pekerjaanUmum)
                @endforeach
        
        <form action="{{route('admin.pekerjaanUmum.update',$pekerjaanUmum->id)}}" method="post">
                @csrf
                @method("put")
            <h2>Form Edit Data Lingkungan Hidup</h2>
            
           
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select id="tahun" class="form-control" name="tahun">
                    
                    @for($i=0;$i<10;$i++)
                    <option value="{{date('Y')-5+$i}}" {{($pekerjaanUmum->tahun== date('Y')-5+$i) ? 'selected':''}}>{{date('Y')-5+$i }}</option>

                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="sumber_dana">Nama Wisata</label>
                <select id="sumber_dana" class="form-control" name="sumber_dana">	
                <option value="">Pilih...</option>
                    <option value="APBN"  @if($pekerjaanUmum->sumber_dana =="APBN") selected @else "" @endif>APBN</option>
                    <option value="APBD"  @if($pekerjaanUmum->sumber_dana =="APBD") selected @else "" @endif>APBD</option>
                    <option value="Luar Negeri" @if($pekerjaanUmum->sumber_dana =="Luar Negeri") selected @else "" @endif>Luar Negeri</option>
                    <option value="Sumber dana Lainya" @if($pekerjaanUmum->sumber_dana =="Sumber dana Lainya") selected @else "" @endif>Sumber dana Lainya</option>
                </select>
            </div>
          
            <div class="form-group">
                <label for="jumlah_dana">Jumlah Dana</label>
                <input type="number" class="form-control" id="jumlah_dana" placeholder="10000000" name="jumlah_dana" value="{{$pekerjaanUmum->jumlah_dana}}"> 
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
</div>


@endsection