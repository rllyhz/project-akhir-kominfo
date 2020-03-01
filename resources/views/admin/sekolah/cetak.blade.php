<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="container mt-2">
		<center>
			<h4>Laporan Data Sekolah</h4>
			<h5><a target="_blank" href="https://www.mdatapusat.semarang.com">www.datapusat.semarang.com</a></h5>
		</center>
        <br/>
        
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Kota</th>
					<th>Jenjang Pendidikan</th>
					<th>Jenis Sekolah</th>
					<th>Jumlah</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($sekolah as $sklh)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$sklh->kota}}</td>
					<td>{{$sklh->jenjang_pendidikan}}</td>
					<td>{{$sklh->jenis_sekolah}}</td>
					<td>{{$sklh->jumlah}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>

</body>
</html>