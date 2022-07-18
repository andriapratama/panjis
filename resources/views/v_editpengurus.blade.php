@extends('layout.v_template')
@section('title', 'Edit Pengurus')

@section('content')
	<form action="/pengurus/update/{{ $pengurus->id_pengurus}}" method="POST" enctype="multipart/form-data">
	@csrf

	<div class="content">
		<div class="row">
			<div class="col-sm-6">

				<div class="form-group">
					<label>NIK</label>
					<input name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ $pengurus->nik}}" readonly="">
					<div class="text-danger">
						@error('nik')
    						{{ $message }}
						@enderror
					</div>
				</div>

				<div class="form-group">
					<label>Nama</label>
					<input name="nama_pengurus" class="form-control @error('nama_pengurus') is-invalid @enderror" value="{{ $pengurus->nama_pengurus}}">
					<div class="text-danger">
						@error('nama_pengurus')
    						{{ $message }}
						@enderror
					</div>
				</div>

				<div class="form-group">
					<label>Jabatan</label>
					<input name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ $pengurus->jabatan}}">
					<div class="text-danger">
						@error('jabatan')
    						{{ $message }}
						@enderror
					</div>
				</div>

				<div class="form-group">
					<label>Foto Pengurus</label>
					<input type="file" name="foto_pengurus" class="form-control @error('foto_pengurus') is-invalid @enderror">
					<div class="text-danger">
						@error('foto_pengurus')
    						{{ $message }}
						@enderror
					</div>
				</div>

				<div class="form-group">
					<button class="btn btn-primary btn-sm">Simpan</button>
				</div> 

			</div>
		</div>
	</div>
@endsection 