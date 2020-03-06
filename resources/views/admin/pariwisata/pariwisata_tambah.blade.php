@extends('layouts.admin.app')
@section('title','Form Input Data')

@section('content')
<div class="container ml-5">
    <div class="row">
        <div class="col-md-8">
        <form action="{{ route('admin.pariwisata.store')}}" method="post">
                @csrf
                @method("post")
            <h2>Form Input Data Pengunjung Tempat Wisata Kota Semarang</h2>

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
                <label for="nama_wisata">nama_wisata</label>
                <select id="nama_wisata" class="form-control" name="nama_wisata">
                <option value="">Pilih...</option>>Setiya Aji Flower Farm</option>
                    <option value="Pagoda Avalokitesvara"  >Pagoda Avalokitesvara</option>
                    <option value="Klenteng Sam Po Kong"  >Klenteng Sam Po Kong</option>
                    <option value="Ayana Gedong Songo">Ayana Gedong Songo</option>
                    <option value="Curug Lawe" >Curug Lawe</option>
                    <option value="Kebun Teh Medini"  >Kebun Teh Medini</option>
                    <option value="Watu Gunung	New Sabana" >Watu Gunung	New Sabana</option>
                    <option value="Rawa Pening" >Rawa Pening</option>
                    <option value="Pondok Kopi Umbul Sidomukti" >Pondok Kopi Umbul Sidomukti</option>
                    <option value="Vanaprastha Gedong Songo Park" >Vanaprastha Gedong Songo Park</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_wisatawan">Jumlah Wisatawan</label>
                <input type="number" class="form-control @error('jumlah_wisatawan') is-invalid @enderror" id="jumlah_wisatawan" placeholder="jumlah_wisatawan" name="jumlah_wisatawan"> 
                @error('jumlah_wisatawan')
                        <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
</div>


@endsection