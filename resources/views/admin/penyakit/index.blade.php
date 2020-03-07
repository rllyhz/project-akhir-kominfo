@extends('layouts.admin.app')

@section('title', 'Data Kesehatan')

@section('page-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Halaman Kesehatan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Penyakit</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row mt-3">
  <div class="col-sm">
    @if (session('info'))
      <div class="alert alert-{{ session('info')['status'] }} alert-dismissible fade show" role="alert">
        {!! session('info')['pesan'] !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
  </div>
</div>

<div class="row">
  <div class="col-sm">
    <div class="container">
      <center>
        <h3 id="chart-title"></h3>
      </center>
      <canvas id="myChart" width="80vw" height="30vh"></canvas>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-sm-4 offset-sm-1">
    <div class="card">
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <div class="card-title">Summary</div>
          <small>
            <li class="list-group-item">Total Kasus : <span class="badge badge-success">{{ $total_penyakit }}</span></li>
            <li class="list-group-item">Kasus Tertinggi : <span class="badge badge-success">{{ $total_penyakit }}</span></li>
            <li class="list-group-item">Total Kasus : <span class="badge badge-success">{{ $total_penyakit }}</span></li>
          </small>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-sm-4 offset-sm-2">
    <div class="card">
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <div class="card-title">Summary</div>
          <small>
            <li class="list-group-item">Total Kasus : <span class="badge badge-success">{{ $total_penyakit }}</span></li>
            <li class="list-group-item">Total Kasus : <span class="badge badge-success">{{ $total_penyakit }}</span></li>
            <li class="list-group-item">Total Kasus : <span class="badge badge-success">{{ $total_penyakit }}</span></li>
          </small>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="row mt-5">
  <div class="col-sm">
    <center>
      <h3>Data Tabular Kasus Penyakit Kota Semarang</h3>
    </center>
  </div>
</div>
<div class="row mt-3">
    <div class="col-sm-3">
        <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#data_penyakit">
        Tambah Data Penyakit
      </button>
    </div>
    <div class="col-sm-6"></div>
    <div class="col-sm-3">
        <button class="btn btn-outline-secondary"data-toggle="modal" data-target="#exim_data_penyakit">
          Export/Import
        </button>
    </div>
</div>

<div class="row">
    <div class="col-sm">
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped table-sm table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Tahun: activate to sort column descending">Tahun</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Jenis Pendidikan: activate to sort column ascending">Jenis Penyakit</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Jumlah: activate to sort column ascending">Jumlah</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penyakit as $item)
                        <tr role="row">
                            <td class="sorting_1">{{ $item['tahun'] }}</td>
                            <td class="">{{ $item->penyakit }}</td>
                            <td class="">{{ $item['jumlah'] }}</td>
                            <td>
                              <a href="{{ route('admin.penyakit.edit', $item['id']) }}" class="badge badge-success">Edit</a>                              
                              <form action="{{ route('admin.penyakit.destroy', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class='btn btn-danger badge' onclick="return confirm('Yakin ingin menghapus?')" type="submit">Hapus</button>
                              </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th rowspan="1" colspan="1">Tahun</th>
                        <th rowspan="1" colspan="1">Jenis Penyakit</th>
                        <th rowspan="1" colspan="1">Jumlah</th>
                        <th rowspan="1" colspan="1">Aksi</th>
                    </tr>
                </tfoot>
              </table>
        </div>
    </div>
</div>
@endsection

@section('modal-section')
<!-- Modal Tambah Data Penyakit -->
<div class="modal fade" id="data_penyakit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kasus Penyakit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.penyakit.store') }}" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
              <label for="tahun">Tahun</label>
              <input type="text" class="form-control" id="tahun" name="tahun" required>
            </div>
            <div class="form-group">
              <label for="jenisSekolah">Jenis Penyakit</label>
              <input type="text" class="form-control" id="jenis_penyakit" name="jenis_penyakit" required>
            </div>
            <div class="form-group">
              <label for="jumlah">Jumlah</label>
              <input type="number" class="form-control" id="jumlah" name="jumlah_penyakit">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Tambah Import/Export -->
<div class="modal fade" id="exim_data_penyakit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export/Import Data Kasus Penyakit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.penyakit.import') }}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            @csrf
            @method('POST')
            <a href="{{ route('admin.sekolah.export') }}" class="btn btn-primary mb-3">Export Data</a>
            <div class="form-group">
              <label for="file">Import Data Penyakit</label>
              <input type="file" class="form-control" id="file" name="file">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Import File</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection


@section('scripts')
<script>  

const xlabels = [],
      dataChart = [],
      ctx = $('#myChart')

ctx.css({
  minWidth: "70vw",
  minHeight: "30vh",
})

// global varables
let dataPenyakit = undefined,
    dataPerTahun = undefined,
    totalPenyakit = undefined,
    namaPenyakit = undefined,
    tahun = [],
    dataset = []


showChart('line')

async function showChart(tipeChart) {
  await getData()
  await setLabels()
  await setDataChart(xlabels, tipeChart)
  setChart(tipeChart)
  document.getElementById("chart-title").innerText = "Data Kasus Penyakit Menular Kota Semarang"
}

async function getData() {
  const response = await fetch('/penyakit/getDataChart')
  const data = await response.json()
  penyakit = data.penyakit
  dataPerTahun = Object.entries(data.dataPerTahun)
  totalpenyakit = data.total_penyakit
  namaPenyakit = data.nama_penyakit
}

function setLabels() {
  namaPenyakit.forEach(penyakit => {
    xlabels.push(penyakit)
  })
}

async function setDataChart(xlabels, tipeChart) {
  let Rwarna = 50, Gwarna = 0, Bwarna = 90;

  dataPerTahun.forEach(data => {
    let datasetSementara = [],
        bgColor = [],
        borderColor = [];

    data[1].forEach(data => {
      datasetSementara.push(data.jumlah)
    })

    // set bgColor dan borderColor
    Rwarna += Math.round((Math.random() * (250 - 10) + 10))
    Gwarna += Math.round((Math.random() * (100 - 10) + 10))

    bgColor.push(`rgba(${Rwarna}, ${Gwarna}, ${Bwarna}, .3)`)
    borderColor.push(`rgba(${Rwarna}, ${Gwarna}, ${Bwarna}, 1)`)

    // set dataset
    dataset.push({
      label: data[0],
      data: datasetSementara,
      type: tipeChart,
      backgroundColor: bgColor,
      borderColor: borderColor,
      borderWidth: 1
    })

    if (Rwarna >= 250) {
      Rwarna = 10
    } else if (Gwarna >= 250) {
      Gwarna = 5
    } 

  })
}

function setChart(tipeChart) {
  const myChart = new Chart(ctx, {
    type: tipeChart,
    data: {
        labels: xlabels,
        datasets: dataset,
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          },
          tooltips: {
            titleFontSize: 14,
            enabled: true,
            mode: 'single',
            // callbacks: {
            //   label: function(tooltipItems, data) {
            //     return tooltipItems.yLabel + ' : ' + tooltipItems.xLabel + " Files";
            //   }
            // }
          },
          legend: {
            labels: {
              // fontColor: 'black',
            }
          }
      }
  })
}

</script>
@endsection