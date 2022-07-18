@extends('layout.v_template')
@section('title', 'Pengurus')

@section('content')
	<a href="/pengurus/add" class="btn btn-primary btn-sm">Tambah</a> <br>
	<br>

	@if (session('pesan'))
	<div class="alert alert-success alert-dismissible">
    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    	<h5><i class="icon fas fa-check"></i> Success! </h5>
    	{{ session('pesan') }}.
    </div>
    @endif
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>NIK</th>
				<th>Nama Pengurus</th>
				<th>Jabatan</th>
				<th>Foto Pengurus</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; ?>
			@foreach ($pengurus as $data)
				<tr>
					<td>{{$no++}}</td>
					<td>{{$data->nik}}</td>
					<td>{{$data->nama_pengurus}}</td>
					<td>{{$data->jabatan}}</td>
					<td><img src="{{ url('foto_pengurus/'.$data->foto_pengurus) }}" width="100px"></td>
					<td>
						<a href="/pengurus/detail/{{ $data->id_pengurus }}" class="btn btn-sm btn-success">Detail</a>
						<a href="/pengurus/edit/{{ $data->id_pengurus }}" class="btn btn-sm btn-warning">Edit</a>
						<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_pengurus}}"> Hapus
                </button> 
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>


@foreach ($pengurus as $data)
	<div class="modal modal-danger fade" id="delete{{ $data->id_pengurus }}">
        <div class="modal-dialog">
          <div class="modal-content bg-default">
            <div class="modal-header">
              <h4 class="modal-title">{{ $data->nama_pengurus }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Apakah Anda Yakin Ingin Menghapus Data Ini?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <a href="/pengurus/delete/{{ $data->id_pengurus }}" class="btn btn-primary">Iya</a>
            </div>
          </div>
           <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
@endforeach


@endsection