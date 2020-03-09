@extends('layouts.admin.app')

@section('title', 'Data Sekolah')

@section('page-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Halaman Pendidikan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Sekolah</li>
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
      <div id="cardChart">
        <div class="card-body">
          <center>
            <h3 id="chart-title"></h3>
          </center>

          <div class="row mt-4">
            <div class="col-sm-4">
              <div class="form-group">
                <button id="btnTampilkanSemua" class="btn btn-success ml-5 sr-only" onclick="tampilkanSemuaData()">Tampilkan Semua</button>
                {{-- <button type="button" class="btn btn-light ml-2" onclick="hapusChart()">Hapus Chart</button> --}}
              </div>
            </div>
          </div>

          <canvas id="myChart" width="80vw" height="30vh"></canvas>

          <div class="container formChart mt-4 sr-only"  id="formChart">
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="tahun">Tahun</label>
                  <select class="form-control" id="tahun" onchange="filterData(this, 'tahun')">
                    
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="jenisSekolah">Jenis Sekolah</label>
                  <select class="form-control" id="jenisSekolah" onchange="filterData(this, 'jenisSekolah')" disabled>
                    <option value="0">--Belum Difilter--</option>
                    <option>Negeri</option>
                    <option>Swasta</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="jenjangPendidikan">Jenjang Pendidikan</label>
                  <select class="form-control" id="jenjangPendidikan" onchange="filterData(this, 'jenjangPendidikan')" disabled>
                    <option value="0">--Belum Difilter--</option>
                    <option>SD</option>
                    <option>SMP</option>
                    <option>SMA/SMK</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-sm-4 offset-sm-1">
    <div class="card">
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <div class="title-card">Summary</div>
          <small>
            <li class="list-group-item">Total Sekolah: <span class="badge badge-success">{{ $total_sekolah }}</span></li>
            <li class="list-group-item">Total SD: <span class="badge badge-success">{{ $total_sekolah }}</span></li>
            <li class="list-group-item">Total SMP: <span class="badge badge-success">{{ $total_sekolah }}</span></li>
            <li class="list-group-item">Total SMA/SMK: <span class="badge badge-success">{{ $total_sekolah }}</span></li>
          </small>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-sm-4 offset-sm-2">
    <div class="card">
      <div class="card-body">
        <ul class="list-group list-group-flush">
          <div class="title-card">Summary</div>
          <small>
            <li class="list-group-item">Total Sekolah: <span class="badge badge-success">{{ $total_sekolah }}</span></li>
            <li class="list-group-item">Total SD: <span class="badge badge-success">{{ $total_sekolah }}</span></li>
            <li class="list-group-item">Total SMP: <span class="badge badge-success">{{ $total_sekolah }}</span></li>
            <li class="list-group-item">Total SMA/SMK: <span class="badge badge-success">{{ $total_sekolah }}</span></li>
          </small>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="row mt-5">
  <div class="col-sm">
    <center>
      <h3>Data Tabular Sekolah Kota Semarang</h3>
    </center>
  </div>
</div>
<div class="row mt-3">
    <div class="col-sm-3">
        {{-- <a href="" class="btn btn-block btn-info">Tambah Data Sekolah</a> --}}
        <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#data_sekolah">
        Tambah Data Sekolah
      </button>
    </div>
    <div class="col-sm-6"></div>
    <div class="col-sm-3">
        <button class="btn btn-outline-secondary "data-toggle="modal" data-target="#exim_data_sekolah">
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
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Kota: activate to sort column ascending">Kecamatan</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Jenjang Pendidikan: activate to sort column ascending">Jenjang Pendidikan</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Jenis Pendidikan: activate to sort column ascending">Jenis Sekolah</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Jumlah: activate to sort column ascending">Jumlah</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sekolah as $item)
                        <tr role="row">
                            <td class="sorting_1">{{ $item['tahun'] }}</td>
                            <td class="">{{ $item->kecamatan->nama_kecamatan }}</td>
                            <td class="">{{ $item->jenjang_pendidikan->nama_jenjang_pendidikan }}</td>
                            <td class="">{{ $item['jenis_sekolah'] }}</td>
                            <td class="">{{ $item['jumlah'] }}</td>
                            <td>
                              <a href="{{ route('admin.sekolah.edit', $item['id']) }}" class="badge badge-success">Edit</a>                              
                              <form action="{{ route('admin.sekolah.destroy', $item['id']) }}" method="POST">
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
                        <th rowspan="1" colspan="1">Kecamatan</th>
                        <th rowspan="1" colspan="1">Jenjang Pendidikan</th>
                        <th rowspan="1" colspan="1">Jenis Sekolah</th>
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
<!-- Modal Tambah Data Sekolah -->
<div class="modal fade" id="data_sekolah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Sekolah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.sekolah.store') }}" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
              <label for="kecamatan">Kecamatan</label>
              <select name="kecamatan" id="kecamatan" class="custom-select" required>
                <option selected>--- pilih ---</option>
                <?php foreach($kecamatan as $k) : ?>
                  <option value="<?= $k['id']; ?>"><?= $k['nama_kecamatan']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="tahun">Tahun</label>
              <input type="tahun" class="form-control" id="tahun" name="tahun" required>
            </div>
            <div class="form-group">
              <label for="jenjangPendidikan">Jenjang Pendidikan</label>
              <select name="jenjangPendidikan" class="custom-select" required>
                <option selected>--- pilih ---</option>
                <?php foreach($jenjang_pendidikan as $jp) : ?>
                  <option value="<?= $jp['id']; ?>"><?= $jp['nama_jenjang_pendidikan']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="jenisSekolah">Jenis Sekolah</label>
              <select name="jenisSekolah" class="custom-select" required>
                <option selected>--- pilih ---</option>
                <option value="Negeri">Negeri</option>
                <option value="Swasta">Swasta</option>
              </select>
            </div>
            <div class="form-group">
              <label for="jumlah">Jumlah Sekolah</label>
              <input type="number" class="form-control" id="jumlah" name="jumlahSekolah">
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
<div class="modal fade" id="exim_data_sekolah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export/Import Data Sekolah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.sekolah.import') }}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            @csrf
            @method('POST')
            <a href="{{ route('admin.sekolah.export') }}" class="btn btn-primary mb-3">Export Data</a>
            <div class="form-group">
              <label for="file">Import Data Sekolah</label>
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


@section('css')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" /> --}}
@endsection


@section('scripts')
<!-- select2 library -->
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}

<!-- chart scripts -->
<script>  
var myChart;
const ctx = $('#myChart'),
      labelChart = 'Data Sekolah Kota Semarang Perkabupaten'

let xlabels = [],
    ylabels = []

const chartOptions = {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: labelChart,
            data: [],
            backgroundColor: [],
            borderColor: [],
            borderWidth: 1
          }]
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
let data,
    dataPerTahun = [],
    dataPerSekolah = [],
    kota = [],
    sekolah,
    tahun = []

var filteredData,
    filteredKondisi = ["0", "0", "0"]

// resolusi chart
ctx.css({
  minWidth: "70vw",
  minHeight: "30vh",
})

// tampilkan default chart
setChart()

async function setChart() {
  await getDataAPI()
  tampilkanSemuaData()

  document.getElementById("cardChart").classList.add('card')
  document.getElementById("formChart").classList.toggle("sr-only")
  document.getElementById("chart-title").innerText = "Data Sekolah Kota Semarang"
  document.querySelector("#btnTampilkanSemua").classList.toggle("sr-only")
}

async function getDataAPI() {
  const response = await fetch('/sekolah/getDataChart')
  data = await response.json()
  sekolah = data.sekolah

  getTahun(sekolah)

  getDataPertahun(sekolah, tahun)

  dataPerSekolah = ubahDataKeDataChart(dataPerTahun, true)
}

function getTahun(data) {
  tahun = data.map(data => data.tahun)
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
  if (!ctx[0].classList.contains("sr-only")) {
    ctx[0].classList.add("sr-only")
  }
  if (myChart) {
    myChart.destroy()
  }
  myChart = undefined
}

function tampilkanChart(chartOptions) {
  myChart = new Chart(ctx, chartOptions)
  if (ctx[0].classList.contains("sr-only")) {
    ctx[0].classList.remove("sr-only")
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
  // reset select tag tahun
  document.getElementById("tahun").innerHTML = ""
  const optionTag = (document.createElement("option"))
  optionTag.setAttribute("value", "0")
  optionTag.innerText = "--Belum Difilter--"
  document.getElementById("tahun").appendChild(optionTag)

  chartOptions.data.datasets[0].label = 'Data Sekolah Kota Semarang Perkabupaten'

  if (document.getElementById("jenisSekolah").hasAttribute("disabled")) {
    // const atrr = document.createAttribute("disabled")
    // document.getElementById("jenisSekolah").setAttributeNode(atrr)
    document.getElementById("jenisSekolah").removeAttribute("disabled")
  }
  if (document.getElementById("jenjangPendidikan").hasAttribute("disabled")) {
    // const atrr = document.createAttribute("disabled")
    // document.getElementById("jenjangPendidikan").setAttributeNode(atrr)
    document.getElementById("jenjangPendidikan").removeAttribute("disabled")
  }

  xlabels = []
  ylabels = []
  dataPerSekolah.forEach(data => {
    xlabels.push(data.kecamatan)
    ylabels.push(data.jumlah)
  })

  isiLabels(xlabels)
  isiDataChart(ylabels)
  setTampilan(ylabels.length)
  tampilkanChart(chartOptions)
  
  // set option tag untuk tahun
  tahun.forEach(tahun => {
    const node = document.createElement("option");
    node.text = tahun
    document.getElementById("tahun").appendChild(node)
  })
  
  // reset juga select options tag
  resetFilterOptions()
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

  setChartDenganFilterisasi()
}

function setChartDenganFilterisasi() {
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
      xlabels.push(data.kecamatan)
      ylabels.push(data.jumlah)
    })
  } else {
    filteredData = ubahDataKeDataChart(filteredData, true)
    filteredData.forEach(data => {
      xlabels.push(data.kecamatan)
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
  const listKota = []
  const dataPerSekolah = []
  
  if (opsi) {
    listData.forEach(list => list.forEach(list => {
      data.push(list)
    }))
  } else {
    listData.forEach(list =>{
      data.push(list)
    })
  }


  data.forEach(sekolah => {
    if (listKota.includes(sekolah.kecamatan)) {
      let kotaSementara = dataPerSekolah.filter(data => data.kecamatan == sekolah.kecamatan)[0]
      let index = dataPerSekolah.indexOf(kotaSementara)
      dataPerSekolah[index].jumlah += parseInt(sekolah.jumlah)
    } else {
      dataPerSekolah.push({
        kecamatan: sekolah.kecamatan,
        jumlah: parseInt(sekolah.jumlah)
      });
      listKota.push(sekolah.kecamatan)
    }
  })

  return dataPerSekolah;
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

function resetFilterOptions() {
  let selectTag = document.querySelector("#tahun")
  let optionsTag = selectTag.options

  for (var opt, j = 0; opt = optionsTag[j]; j++) {
    if (opt.value == '0') {
        selectTag.selectedIndex = j;
        break;
    }
  }

  selectTag = document.querySelector("#jenisSekolah")
  optionsTag = selectTag.options

  for (var opt, j = 0; opt = optionsTag[j]; j++) {
    if (opt.value == '0') {
        selectTag.selectedIndex = j;
        break;
    }
  }

  selectTag = document.querySelector("#jenjangPendidikan")
  optionsTag = selectTag.options
  
  for (var opt, j = 0; opt = optionsTag[j]; j++) {
    if (opt.value == '0') {
        selectTag.selectedIndex = j;
        break;
    }
  }
}

</script>
@endsection