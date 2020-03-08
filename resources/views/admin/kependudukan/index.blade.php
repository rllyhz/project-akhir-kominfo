@extends('layouts.admin.app')
@section('title','Data Kependudukan')
@section('content')
        <div class="container ml-5">
        
            <div class="row">
                <div class="col-md-10">
                    <h1>Data Kependudukan</h1>
                    <div class="row">
                        <div class="col-md-4">
                    <a href="{{ route('admin.kep_pend_add')}}" class="btn btn-primary mb-4"> <i class="fa fa-plus"></i> Tambah Data</a>
                        </div>
                        <div class="col-md">
                            <a href="{{route('admin.kep_export_excell')}}" class="btn btn-xs btn-success"> <i class="fa fa-download"></i> Export</a>
                            <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#importExcel"> <i class="fa fa-file"></i> Import</button>
                            
                            		<!-- Import Excel -->
                            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="{{route('admin.kep_import_excell')}}" enctype="multipart/form-data">
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
                                <table class="table table-bordered pendidikan" id="Kependudukan" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th >No</th>
                                        <th >Kecamatan</th>
                                        <th >Tahun</th>
                                        <th >Status</th>
                                        <th >Jumlah</th>
                                        <th >Action</th>
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
      $('#Kependudukan').DataTable({
        buttons: [
        'copy', 'excel', 'pdf'
    ],
        processing: true,
        serverSide: true,
        ajax:{
            url:"{{ route('admin.kependudukan.index') }}",
        },
        columns: [
            {
                data :'id',
                name:'id'
            },
            
            {
                data: 'nama_kecamatan', 
                name: 'nama_kecamatan'
            },
            {
                data: 'tahun', 
                name: 'tahun'
            },
            {
                data: 'status', 
                name: 'status'
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