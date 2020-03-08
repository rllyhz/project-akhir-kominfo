@extends('layouts.admin.app')
@section('title','Data Kebarakan Di Kota Semarang')
@section('content')
        <div class="container ml-5">
        
            <div class="row">
                <div class="col-md-10">
                    <h1>Data Kebarakaran di Kota Semarang</h1>
                    <div class="row">
                        <div class="col-sm">
                          <div class="container">
                            <center>
                              <h3 id="chart-title"></h3>
                            </center>
                            <canvas id="myChart" width="80vw" height="33vh"></canvas>
                          </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="filter">Filter by Tempat Kejadian</label>
                                <select name="filter" class="form-control" id="filter" onchange="btnFilterChart(this)">
                                    <option value="0">--Belum difilter--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="">:</label>
                                <button class="btn btn-dark btn-sm form-control" onclick="btnResetChart()">Reset</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4">
                    <a href="{{ route('admin.pen_penanggulangan_bencana_add')}}" class="btn btn-primary mb-4"> <i class="fa fa-plus"></i> Tambah Data</a>
                        </div>
                        <div class="col-md">
                            <a href="{{route('admin.pb_export_excell')}}" class="btn btn-xs btn-success"> <i class="fa fa-download"></i> Export</a>
                            <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#importExcel"> <i class="fa fa-file"></i> Import</button>
                            		<!-- Import Excel -->
                            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="{{route('admin.pb_import_excell')}}" enctype="multipart/form-data">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                            </div>
                                            <div class="modal-body">
                    
                                                {{ csrf_field() }}
                    
                                                <label>Pilih file excel</label>
                                                <div class="form-group">
                                                    <input type="file" name="file" required="required">
                                                </div>
                    
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Import</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    @if (session('status'))
                            <div class="alert alert-success mt-2">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered pendidikan" id="PenanggulanganBencana" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Penyebab</th>
                                        <th>Kategori Tempat Kebakaran</th>
                                        <th>Jumlah</th>
                                        <th>Action</th>
                                        
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end card -->
                  
                </div>
            </div>
        </div>

<script type="text/javascript">
  $(document).ready(function () {
      
      console.log('ok')
      $('#PenanggulanganBencana').DataTable({
        buttons: [
        'copy', 'excel', 'pdf'
    ],
        processing: true,
        serverSide: true,
        ajax:{
            url:"{{ route('admin.penanggulanganBencana.index') }}",
        },
        columns: [
            {
                data :'id',
                name:'id'
            },
            
            {
                data: 'tahun', 
                name: 'tahun'
            },
            {
                data: 'penyebab', 
                name: 'penyebab'
            },
            {
                data: 'tempat_kebakaran', 
                name: 'tempat_kebakaran'
            },
            {
                data: 'jumlah', 
                name: 'jumlah'
            },
            {
                data: 'action', 
                name: 'action', 
                orderable: false,
                 searchable: false
            },

        ]

    });

    

  });

</script>
@endsection

@section('scripts')
<script>  
var myChart,
    canvas = document.getElementById('myChart'),
    ctx = canvas.getContext('2d'),
    labelChart = 'Data Pengunjung Wisata Kota Semarang',
    datasets = [],
    labels = [],
    xlabels = []

const chartOptions = {
    type: 'line',
    data: {
        labels: [],
        datasets: datasets,
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          },
          legend: {
            labels: {
              // fontColor: 'black',
            }
          }
      }
  };

// persiapan data yang dibutuhkan
var data,
    dataPerTahun = [],
    dataPerPenyebab = [],
    data_kebakaran,
    tempat_kebakaran = [],
    tahun = []

// tampilkan default chart
setChart()

async function setChart() {
  await getDataAPI()
  isiDataset(null, 'line')
  isiLabels(labels)
  myChart = new Chart(ctx, chartOptions)
  tempat_kebakaran.forEach(tempat => {
    const optionTag = document.createElement("option")
    optionTag.innerText = tempat
    optionTag.setAttribute('value', tempat)
    document.querySelector('#filter').appendChild(optionTag) 
  })
}

async function getDataAPI() {
  const response = await fetch('/penanggulanganBencana/getDataChart')
  data = await response.json()
  data_kebakaran = data

  getTahun(data_kebakaran)
  getDataPertahun(data_kebakaran, tahun)
  getLabels(data_kebakaran)
  getTempatKebakaran(data_kebakaran)
  dataPerPenyebab = ubahDataKeDataChart(dataPerTahun, true)
}

function getTahun(data) {
  tahun = data.map(data => data.tahun)
                  .filter((value, index, self) => self.indexOf(value) === index)
                  .sort()
}

function getLabels(data) {
  labels = []
  labels = data.map(data => data.penyebab)
                  .filter((value, index, self) => self.indexOf(value) === index)
                  .sort()
}

function getTempatKebakaran(data) {
    tempat_kebakaran = data.map(data => data.tempat_kebakaran)
                            .filter((value, index, self) => self.indexOf(value) === index)
                            .sort()
}

function getDataPertahun(data, listTahun) {
  listTahun.forEach(tahun => {
    dataPerTahun.push(
      data.filter(data => data.tahun == tahun)
    )
  })
}

async function isiDataset(data, tipeChart) {
  let Rwarna = 50, Gwarna = 0, Bwarna = 90;
  let index = 0
  let dataChart = undefined

  // cek data kosong?
  if (typeof data != "undefined" && data != null && data.length != null && data.length > 0) {
    dataChart = data
  } else {
    dataChart = dataPerTahun
  }

  dataChart.forEach(data => {
    let datasetSementara = [],
        bgColor = [],
        borderColor = [];

    data.forEach(data => {
      datasetSementara.push(data.jumlah)
    })

    // set bgColor dan borderColor
    Rwarna += Math.round((Math.random() * (250 - 10) + 10))
    Gwarna += Math.round((Math.random() * (100 - 10) + 10))

    bgColor.push(`rgba(${Rwarna}, ${Gwarna}, ${Bwarna}, 0)`)
    borderColor.push(`rgba(${Rwarna}, ${Gwarna}, ${Bwarna}, 1)`)

    // // set dataset
    datasets.push({
      label: tahun[index],
      data: datasetSementara,
      type: tipeChart,
      backgroundColor: bgColor,
      borderColor: borderColor,
      borderWidth: 2
    })

    if (Rwarna >= 250) {
      Rwarna = 10
    } else if (Gwarna >= 250) {
      Gwarna = 5
    }

    index++
  })

  chartOptions.data.datasets = datasets
}

function isiLabels(labels = []) {
  if (!Array.isArray(labels)) {
    console.error("Data label yang dikirimkan harus berbentuk array!")
  } else {
    chartOptions.data.labels = labels
  }
}

function hapusDataset() {
  datasets = []
}

function ubahDataKeDataChart(listData, opsi) {
  const data = []
  const penyebab = []
  const dataPerPenyebab = []
  
  if (opsi) {
    listData.forEach(list => list.forEach(list => {
      data.push(list)
    }))
  } else {
    listData.forEach(list =>{
      data.push(list)
    })
  }


  data.forEach(data_kebakaran => {
    if (penyebab.includes(data_kebakaran.penyebab)) {
      let tempatSementara = dataPerPenyebab.filter(data => data.penyebab == data_kebakaran.penyebab)[0]
      let index = dataPerPenyebab.indexOf(tempatSementara)
      dataPerPenyebab[index].jumlah += parseInt(data_kebakaran.jumlah)
    } else {
      dataPerPenyebab.push({
        penyebab: data_kebakaran.penyebab,
        jumlah: parseInt(data_kebakaran.jumlah)
      });
      penyebab.push(data_kebakaran.penyebab)
    }
  })

  return dataPerPenyebab;
}

function filterChart(value) {
    let dataPerTahun_Baru = dataPerTahun,
        dataChart = undefined

    const dataBaru = []

    dataPerTahun_Baru.forEach(dataPerTahun => {
        dataBaru.push(dataPerTahun.filter(data => data.tempat_kebakaran == value))
    })

    myChart.destroy()
    hapusDataset()

    dataChart = ubahDataKeDataChart(dataBaru, true)
    getLabels(dataChart)
    isiDataset(dataBaru, 'line')
    isiLabels(labels)

    myChart = new Chart(ctx, chartOptions)
}

function resetChart() {
    myChart.destroy()
    hapusDataset()

    getLabels(data_kebakaran)
    isiDataset(null, 'line')
    isiLabels(labels)
    
    myChart = new Chart(ctx, chartOptions)
}

function btnFilterChart(el) {
    const value = el.value
    if (value == '0') {
        btnResetChart()
        return true
    }
    filterChart(value)
}

function btnResetChart() {
    resetChart()

    const selectTag = document.querySelector("#filter")
    const optionsTag = selectTag.options
    // const optionsTag = selectTag.children
    for (var opt, j = 0; opt = optionsTag[j]; j++) {
        if (opt.value == '0') {
            selectTag.selectedIndex = j;
            break;
        }
    }
}

</script>
@endsection