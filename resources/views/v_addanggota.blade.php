@extends('layout.v_template')
@section('title', 'Add Anggota')

@section('content')

<form action="/anggota/insert" method="POST" enctype="multipart/form-data">
	@csrf

	<div class="content">
		<div class="row">
			<div class="col-sm-6">

				<div class="form-group">
					<label>NIK</label>
					<input name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik')}}">
					<div class="text-danger">
						@error('nik')
    						{{ $message }}
						@enderror
					</div>
				</div>

				<div class="form-group">
					<label>Nama Lengkap</label>
					<input name="nama_anggota" class="form-control @error('nama_anggota') is-invalid @enderror" value="{{ old('nama_anggota')}}">
					<div class="text-danger">
						@error('nama_anggota')
    						{{ $message }}
						@enderror
					</div>
				</div>

				<div class="form-group">
					<label>Alamat</label>
					<input name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat')}}">
					<div class="text-danger">
						@error('alamat')
    						{{ $message }}
						@enderror
					</div>
				</div>

				<div class="form-group">
					<label>No HP</label>
					<input name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp')}}">
					<div class="text-danger">
						@error('no_hp')
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