@extends('layouts.admin.app')
@section('title','Data Pengunjung Wisata Kota Semarang')
@section('content')
        <div class="container ml-5">
        
            <div class="row">
                <div class="col-md-10">
                    <h1>Data Pengunjung Wisata Kota Semarang</h1>
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
                    <div class="row">
                        <div class="col-md-4">
                    <a href="{{ route('admin.par_pariwisata_add')}}" class="btn btn-primary mb-4"> <i class="fa fa-plus"></i> Tambah Data</a>
                        </div>
                        <div class="col-md">
                            <a href="{{route('admin.par_export_excell')}}" class="btn btn-xs btn-success"> <i class="fa fa-download"></i> Export</a>
                            <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#importExcel"> <i class="fa fa-file"></i> Import</button>
                            <!-- cetak pdf -->
                            <button  class="btn btn-xs btn-info" data-toggle="modal" data-target="#cetakPdf" > <i class="fa fa-print"></i> Print</button>
                            		<!-- Import Excel -->
                            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="{{route('admin.par_import_excell')}}" enctype="multipart/form-data">
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
                                <table class="table table-bordered pendidikan" id="pariwisata" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>No</th>
                                        <th>Tahun</th>
                                        <th>Nama Wisata</th>
                                        <th>Jumlah Wisatawan</th>
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
      $('#pariwisata').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url:"{{route('admin.pariwisata.index')}}",
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
                data: 'nama_wisata', 
                name: 'nama_wisata'
            },
            {
                data: 'jumlah_wisatawan', 
                name: 'jumlah_wisatawan'
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
    datasets = []

let xlabels = [],
    ylabels = []

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
    dataPerParawisata = [],
    data_pariwisata,
    tahun = [],
    filteredData,
    filteredKondisi = ["0", "0", "0"]

// tampilkan default chart
setChart()

async function setChart() {
  await getDataAPI()
  isiDataset(xlabels, 'line')
  console.log(chartOptions)
  return false
  hapusChart()
  setLabel()
  tampilkanChart()
}

async function getDataAPI() {
  const response = await fetch('/pariwisata/getDataChart')
  data = await response.json()
  data_pariwisata = data

  getTahun(data_pariwisata)
  getDataPertahun(data_pariwisata, tahun)
  dataPerParawisata = ubahDataKeDataChart(dataPerTahun, true)
}

function getTahun(data) {
  tahun = data.map(data => data.tahun)
                  .filter((value, index, self) => self.indexOf(value) === index)
                  .sort()
}

function getLabel(data) {
  xlabels = data.map(data => data.nama_wisata)
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

function filterByTahun(data ,tahun) {
  const filteredSekolah = data.filter(sekolah => sekolah.tahun == tahun)
  return filteredSekolah
}

// fungsi utama chart
function hapusChart() {
  if (!canvas.classList.contains("sr-only")) {
    canvas.classList.add("sr-only")
  }
  if (myChart) {
    myChart.destroy()
  }
  myChart = undefined
}

function tampilkanChart(chartOptions) {
  myChart = new Chart(ctx, chartOptions)
  if (canvas.classList.contains("sr-only")) {
    canvas.classList.remove("sr-only")
  }
}

function isiDataChart(data = []) {
  if (!Array.isArray(data)) {
    console.error("Data Chart yang dikirimkan harus berbentuk array!")
  } else {
    data.forEach(data => {
      chartOptions.data.datasets[0].data.push(data)
    })
  }
}

async function isiDataset(xlabels, tipeChart) {
  let Rwarna = 50, Gwarna = 0, Bwarna = 90;
  let index = 0

  dataPerTahun.forEach(data => {
    let datasetSementara = [],
        bgColor = [],
        borderColor = [];

    data.forEach(data => {
      datasetSementara.push(data.jumlah_wisatawan)
    })

    // set bgColor dan borderColor
    Rwarna += Math.round((Math.random() * (250 - 10) + 10))
    Gwarna += Math.round((Math.random() * (100 - 10) + 10))

    bgColor.push(`rgba(${Rwarna}, ${Gwarna}, ${Bwarna}, .3)`)
    borderColor.push(`rgba(${Rwarna}, ${Gwarna}, ${Bwarna}, 1)`)

    // // set dataset
    datasets.push({
      label: tahun[index],
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

function hapusIsiChart() {
  chartOptions.data.datasets[0].data = []
}

function hapusXLabels() {
  chartOptions.data.labels = []
}

function hapusDataset() {

}

function setTampilan(jumlahDataChart) {
  let Rwarna = 10,
      Gwarna = 255

  const bgColor = [],
        borderColor = []

  hapusWarnaTampilan()

  for (let index = 0; index < jumlahDataChart; index++) {
    bgColor.push(`rgba(${Rwarna}, ${Gwarna}, ${(index * 10)}, 0.2)`)
    borderColor.push(`rgba(${Rwarna-50}, ${Gwarna-50}, ${(index * 10)}, 1)`)
    if (Rwarna > 255) {
      Rwarna = 0
    }
    if (Gwarna < 0) {
      Gwarna = 255
    }
    Rwarna += 90
    Gwarna -= 20
  }

  setWarnaTampilan(bgColor, borderColor)
}

function setWarnaTampilan(warnaBackground, warnaBorder) {
  chartOptions.data.datasets[0].backgroundColor = warnaBackground
  chartOptions.data.datasets[0].borderColor = warnaBorder
}

function hapusWarnaTampilan() {
  chartOptions.data.datasets[0].backgroundColor = []
  chartOptions.data.datasets[0].borderColor = []
}


// interaksi user
// tampilkan no-filter
function tampilkanSemuaData() {
  hapusChart()
  hapusIsiChart()
  hapusXLabels()
  hapusWarnaTampilan()

  chartOptions.data.datasets[0].label = labelChart

  xlabels = []
  ylabels = []
  console.log(dataPerParawisata)
  return;
  dataPerParawisata.forEach(data => {
    xlabels.push(data.nama_wisata)
    ylabels.push(data.jumlah_wisatawan)
  })

  isiLabels(xlabels)
  isiDataChart(ylabels)
  setTampilan(ylabels.length)
  tampilkanChart(chartOptions)
}

function filterData(el, filtering) {
  const filter = ["tahun", "jenisSekolah", "jenjangPendidikan"]
  let aa;

  if (el.value === "--Belum Difilter--")
  {
    if (filtering == filter[0]) {
      filteredKondisi[0] = "0"
    } else if (filtering == filter[1]) {
      filteredKondisi[1] = "0"
    } else if (filtering == filter[2]) {
      filteredKondisi[2] = "0"
    }
  } else
  {
    if (filtering == filter[0]) {
      filteredKondisi[0] = "1"
      aa = filter[0]
    } else if (filtering == filter[1]) {
      filteredKondisi[1] = "1"
      aa = filter[1]
    } else if (filtering == filter[2]) {
      filteredKondisi[2] = "1"
      aa = filter[1]
    }
  }

  setChartDenganFilterisasi(aa)
}

function setChartDenganFilterisasi(aa) {
  // tidak ada filter
  if (filteredKondisi === "000") {
    tampilkanSemuaData()
    return;
  }

  xlabels = []
  ylabels = []

  // tahun difilter ?
  if (filteredKondisi[0] === "1") {
    const filteredTahun = (document.getElementById("tahun")).value
    const index = tahun.indexOf(parseInt(filteredTahun))
    filteredData = dataPerTahun[index]
  } else {
    filteredData = dataPerTahun
  }
  
  // jenis sekolah difilter ?
  if (filteredKondisi[1] === "1") {
    const filteredJenisSekolah = (document.getElementById("jenisSekolah")).value
    if (filteredKondisi[0] === "1") {
      filteredData = filteredData.filter(data => data.jenis_sekolah == filteredJenisSekolah)
    } else {
      const filterSementara = []
      filteredData.forEach(pertahun => {
        filterSementara.push(pertahun.filter(data => data.jenis_sekolah == filteredJenisSekolah))
      })
      filteredData = filterSementara
    }
  }

  // jenjang pendidikan difilter ?
  if (filteredKondisi[2] === "1") {
    const filteredJenjangPendidikan = (document.getElementById("jenjangPendidikan")).value
    if (filteredKondisi[0] === "1") {
      filteredData = filteredData.filter(data => data.jenjang_pendidikan == filteredJenjangPendidikan)
    } else {
      const filterSementara = []
      filteredData.forEach(pertahun => {
        filterSementara.push(pertahun.filter(data => data.jenjang_pendidikan == filteredJenjangPendidikan))
      })
      filteredData = filterSementara
    }
  }

  hapusChart()
  hapusIsiChart()
  hapusXLabels()
  hapusWarnaTampilan()

  // set xlabels dan ylabels
  // jika filteredData kosong
  if (filteredData.length <= 0) {
    xlabels.push("Data Yang Anda Filter Tidak Ada!")
  }
  
  if (filteredKondisi[0] === "1") {
    filteredData = ubahDataKeDataChart(filteredData, false)
    filteredData.forEach(data => {
      xlabels.push(data.nama_wisata)
      ylabels.push(data.jumlah)
    })
  } else {
    filteredData = ubahDataKeDataChart(filteredData, true)
    filteredData.forEach(data => {
      xlabels.push(data.nama_wisata)
      ylabels.push(data.jumlah)
    })
  }

  // set label
  setLabel()

  isiLabels(xlabels)
  isiDataChart(ylabels)
  setTampilan(xlabels.length)
  tampilkanChart(chartOptions)
}

function ubahDataKeDataChart(listData, opsi) {
  const data = []
  const listTempatWisata = []
  const dataPerParawisata = []
  
  if (opsi) {
    listData.forEach(list => list.forEach(list => {
      data.push(list)
    }))
  } else {
    listData.forEach(list =>{
      data.push(list)
    })
  }


  data.forEach(pariwisata => {
    if (listTempatWisata.includes(pariwisata.nama_wisata)) {
      let tempatSementara = dataPerParawisata.filter(data => data.nama_wisata == pariwisata.nama_wisata)[0]
      let index = dataPerParawisata.indexOf(tempatSementara)
      dataPerParawisata[index].jumlah_wisatawan += parseInt(pariwisata.jumlah_wisatawan)
    } else {
      dataPerParawisata.push({
        nama_wisata: pariwisata.nama_wisata,
        jumlah_wisatawan: parseInt(pariwisata.jumlah_wisatawan)
      });
      listTempatWisata.push(pariwisata.nama_wisata)
    }
  })

  return dataPerParawisata;
}

function setLabel() {
  const Tahun = document.getElementById("tahun").value
  const JenisSekolah = document.getElementById("jenisSekolah").value
  const JenjangPendidikan = document.getElementById("jenjangPendidikan").value

  if (filteredKondisi[0] === "1" && filteredKondisi[1] === "0" && filteredKondisi[2] === "0") {
    chartOptions.data.datasets[0].label = `Data Sekolah Kota Semarang Perkabupaten - (Tahun ${Tahun})`
  }
  if (filteredKondisi[0] === "0" && filteredKondisi[1] === "1" && filteredKondisi[2] === "0") {
    chartOptions.data.datasets[0].label = `Data Sekolah Kota Semarang Perkabupaten - Kategori SD/SMP/SMA/SMK ${JenisSekolah}`
  }
  if (filteredKondisi[0] === "0" && filteredKondisi[1] === "0" && filteredKondisi[2] === "1") {
    chartOptions.data.datasets[0].label = `Data Sekolah Kota Semarang Perkabupaten - Kategori ${JenjangPendidikan} Negeri/Swasta`
  }
  if (filteredKondisi[0] === "0" && filteredKondisi[1] === "1" && filteredKondisi[2] === "1") {
    chartOptions.data.datasets[0].label = `Data Sekolah Kota Semarang Perkabupaten - Kategori ${JenjangPendidikan} ${JenisSekolah}`
  }
  if (filteredKondisi[0] === "1" && filteredKondisi[1] === "0" && filteredKondisi[2] === "1") {
    chartOptions.data.datasets[0].label = `Data Sekolah Kota Semarang Perkabupaten - Kategori ${JenjangPendidikan} Negeri/Swasta (Tahun ${Tahun})`
  }
  if (filteredKondisi[0] === "1" && filteredKondisi[1] === "1" && filteredKondisi[2] === "0") {
    chartOptions.data.datasets[0].label = `Data Sekolah Kota Semarang Perkabupaten - Kategori SD/SMP/SMA/SMK ${JenisSekolah} (Tahun ${Tahun})`
  }
  if (filteredKondisi[0] === "1" && filteredKondisi[1] === "1" && filteredKondisi[2] === "1") {
    chartOptions.data.datasets[0].label = `Data Sekolah Kota Semarang Perkabupaten - Kategori ${JenjangPendidikan} ${JenisSekolah} (Tahun ${Tahun})`
  }
}

</script>
@endsection