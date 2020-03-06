@extends('layouts.admin.app')
@section('title','Form Update Data')

@section('content')
<div class="container ml-5">
    <div class="row">
        <div class="col-md-8">
        @foreach($pariwisatas as $pariwisata)
                @endforeach
        
        <form action="{{route('admin.pariwisata.update',$pariwisata->id)}}" method="post">
                @csrf
                @method("put")
            <h2>Form Edit Data Lingkungan Hidup</h2>
            
           
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select id="tahun" class="form-control" name="tahun">
                    
                    @for($i=0;$i<10;$i++)
                    <option value="{{date('Y')-5+$i}}" {{($pariwisata->tahun== date('Y')-5+$i) ? 'selected':''}}>{{date('Y')-5+$i }}</option>

                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="nama_wisata">Nama Wisata</label>
                <select id="nama_wisata" class="form-control" name="nama_wisata">
                <option value="">Pilih...</option>	

                    <option value="Setiya Aji Flower Farm"  @if($pariwisata->nama_wisata =="Setiya Aji Flower Farm") selected @else "" @endif >Setiya Aji Flower Farm</option>
                    <option value="Pagoda Avalokitesvara" @if($pariwisata->nama_wisata =="Pagoda Avalokitesvara") selected @else "" @endif >Pagoda Avalokitesvara</option>
                    <option value="Klenteng Sam Po Kong" @if($pariwisata->nama_wisata =="Klenteng Sam Po Kong") selected @else "" @endif >Klenteng Sam Po Kong</option>
                    <option value="Ayana Gedong Songo" @if($pariwisata->nama_wisata =="Ayana Gedong Songo") selected @else "" @endif >Ayana Gedong Songo</option>
                    <option value="Curug Lawe" @if($pariwisata->nama_wisata =="Curug Lawe") selected @else "" @endif >Curug Lawe</option>
                    <option value="Kebun Teh Medini" @if($pariwisata->nama_wisata =="Kebun Teh Medini") selected @else "" @endif >Kebun Teh Medini</option>
                    <option value="Watu Gunung	New Sabana" @if($pariwisata->nama_wisata =="Watu Gunung	New Sabana") selected @else "" @endif >Watu Gunung	New Sabana</option>
                    <option value="Rawa Pening" @if($pariwisata->nama_wisata =="Rawa Pening") selected @else "" @endif >Rawa Pening</option>
                    <option value="Pondok Kopi Umbul Sidomukti" @if($pariwisata->nama_wisata =="Pondok Kopi Umbul Sidomukti") selected @else "" @endif >Pondok Kopi Umbul Sidomukti</option>
                    <option value="Vanaprastha Gedong Songo Park" @if($pariwisata->nama_wisata =="Vanaprastha Gedong Songo Park") selected @else "" @endif >Vanaprastha Gedong Songo Park</option>
                </select>
            </div>
          
            <div class="form-group">
                <label for="jumlah_wisatawan">Jumlah Wisatawan</label>
                <input type="number" class="form-control" id="jumlah_wisatawan" placeholder="jumlah_wisatawan" name="jumlah_wisatawan" value="{{$pariwisata->jumlah_wisatawan}}"> 
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
</div>


@endsection