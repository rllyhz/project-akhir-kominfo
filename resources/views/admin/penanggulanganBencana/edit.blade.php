@extends('layouts.admin.app')
@section('title','Form Update Data')

@section('content')
<div class="container ml-5">
    <div class="row">
        <div class="col-md-8">
        @foreach($penanggulanganBencanas as $penanggulanganBencana)
                @endforeach
        
        <form action="{{route('admin.penanggulanganBencana.update',$penanggulanganBencana->id)}}" method="post">
                @csrf
                @method("put")
            <h2>Form Edit Data Kebakaran di Kota Semarang</h2>
            
           
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select id="tahun" class="form-control" name="tahun">
                    
                    @for($i=0;$i<10;$i++)
                    <option value="{{date('Y')-5+$i}}" {{($penanggulanganBencana->tahun== date('Y')-5+$i) ? 'selected':''}}>{{date('Y')-5+$i }}</option>

                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="penyebab">Penyebab</label>
                <select id="penyebab" class="form-control" name="penyebab">
                <option value="">Pilih...</option>
                    <option value="Konsleting Listrik"  @if($penanggulanganBencana->penyebab =="Konsleting Listrik") selected @else "" @endif>Konsleting Listrik</option>
                    <option value="Kebocoran Gas"  @if($penanggulanganBencana->penyebab =="Kebocoran Gas") selected @else "" @endif >Kebocoran Gas</option>
                    <option value="Selang Bocor" @if($penanggulanganBencana->penyebab =="Selang Bocor") selected @else "" @endif>Selang Bocor</option>
                    <option value="Lainnya"  @if($penanggulanganBencana->penyebab =="Lainnya") selected @else "" @endif>Lainnya</option>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="tempat_kebakaran">Kategori tempat Kebakaran</label>
                <select id="tempat_kebakaran" class="form-control" name="tempat_kebakaran">
                <option value="">Pilih...</option>
                    <option value="Tempat Tinggal"  @if($penanggulanganBencana->tempat_kebakaran =="Tempat Tinggal") selected @else "" @endif>Tempat Tinggal</option>
                    <option value="Ruko" @if($penanggulanganBencana->tempat_kebakaran =="Ruko") selected @else "" @endif >Ruko</option>
                    <option value="Kos" @if($penanggulanganBencana->tempat_kebakaran =="Kos") selected @else "" @endif>Kos</option>
                    <option value="Tempat Ibadah" @if($penanggulanganBencana->tempat_kebakaran =="Tempat Ibadah") selected @else "" @endif>Tempat Ibadah</option>
                    <option value="Lainnya"@if($penanggulanganBencana->tempat_kebakaran =="Lainnya") selected @else "" @endif >Lainnya</option>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah </label>
                <input type="text" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" placeholder="jumlah" name="jumlah"  value="{{$penanggulanganBencana->jumlah}}"> 
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