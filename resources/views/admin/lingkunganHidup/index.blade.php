@extends('layouts.admin.app')
@section('title','Data Lingkungan Hidup')
@section('content')
        <div class="container ml-5">
            <div class="row">
                <div class="col-md-10">
                    <h1>Data Lingkungan Hidup</h1>
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
                    <div class="row mt-5">
                        <div class="col-md-4">
                    <a href="{{ route('admin.lh_lingkungan_add')}}" class="btn btn-primary mb-4"> <i class="fa fa-plus"></i> Tambah Data</a>
                        </div>
                        <div class="col-md">
                            <a href="{{route('admin.lh_export_excell')}}" class="btn btn-xs btn-success"> <i class="fa fa-download"></i> Export</a>
                            <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#importExcel"> <i class="fa fa-file"></i> Import</button>
                            
                            		<!-- Import Excel -->
                            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="{{route('admin.lh_import_excell')}}" enctype="multipart/form-data">
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
                                <table class="table table-bordered pendidikan" id="LingkunganHidup" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Jenis Rumah</th>
                                            <th scope="col">Debit Air</th>
                                            <th scope="col">Action</th>
                                        
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
      $('#LingkunganHidup').DataTable({
        buttons: [
        'copy', 'excel', 'pdf'
    ],
        processing: true,
        serverSide: true,
        ajax:{
            url:"{{ route('admin.lingkunganHidup.index') }}",
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
                data: 'jenis_rumah', 
                name: 'jenis_rumah'
            },
            {
                data: 'debit_air', 
                name: 'debit_air'
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
    dataPerJenisRumah = [],
    data_lingkunganHidup,
    tahun = []

// tampilkan default chart
setChart()

async function setChart() {
  await getDataAPI()
  isiDataset(xlabels, 'line')
  isiLabels(labels)
  myChart = new Chart(ctx, chartOptions)
}

async function getDataAPI() {
  const response = await fetch('/lingkunganHidup/getDataChart')
  data = await response.json()
  data_lingkunganHidup = data

  getTahun(data_lingkunganHidup)
  getDataPertahun(data_lingkunganHidup, tahun)
  getLabels(data_lingkunganHidup)
  dataPerJenisRumah = ubahDataKeDataChart(dataPerTahun, true)
}

function getTahun(data) {
  tahun = data.map(data => data.tahun)
                  .filter((value, index, self) => self.indexOf(value) === index)
                  .sort()
}

function getLabels(data) {
  labels = data.map(data => data.jenis_rumah)
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

async function isiDataset(xlabels, tipeChart) {
  let Rwarna = 50, Gwarna = 0, Bwarna = 90;
  let index = 0

  dataPerTahun.forEach(data => {
    let datasetSementara = [],
        bgColor = [],
        borderColor = [];

    data.forEach(data => {
      datasetSementara.push(data.debit_air)
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
  const jenis_rumah = []
  const dataPerJenisRumah = []
  
  if (opsi) {
    listData.forEach(list => list.forEach(list => {
      data.push(list)
    }))
  } else {
    listData.forEach(list =>{
      data.push(list)
    })
  }


  data.forEach(lingkungan => {
    if (jenis_rumah.includes(lingkungan.jenis_rumah)) {
      let tempatSementara = dataPerJenisRumah.filter(data => data.jenis_rumah == lingkungan.jenis_rumah)[0]
      let index = dataPerJenisRumah.indexOf(tempatSementara)
      dataPerJenisRumah[index].debit_air += parseInt(lingkungan.debit_air)
    } else {
      dataPerJenisRumah.push({
        jenis_rumah: lingkungan.jenis_rumah,
        debit_air: parseInt(lingkungan.debit_air)
      });
      jenis_rumah.push(lingkungan.jenis_rumah)
    }
  })

  return dataPerJenisRumah;
}

</script>
@endsection