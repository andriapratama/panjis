@extends('layout.v_template')
@section('title', 'Anggota')

@section('content')
	<div class="anggota__container">
		<div class="anggota__head">
			<a class="anggota__button-primary" href="/anggota/new">Tambah</a>
		</div>

		<table class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>NIK</th>
					<th>Nama Lengkap</th>
					<th>Alamat</th>
					<th>Nomor HP</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody id="table-body"></tbody>
		</table>
	</div>

	@include('js/javascript')
	<script type="text/javascript">
		$("document").ready(function() {
			showData();
		});

		function showData() {
			$.ajax({
				type: 'GET',
				url: '/member',
				success: function(result) {
					const element = $('#table-body').html("");
					result.data.forEach((value, index) => {
						element.append(
							'<tr>'+
								'<td>'+ (index+1) +'</td>'+
								'<td>'+ value.nik +'</td>'+
								'<td>'+ value.full_name +'</td>'+
								'<td>'+ value.address +'</td>'+
								'<td>'+ value.phone_number +'</td>'+
								'<td>'+
									'<div class="anggota__table-button">'+
										'<a class="anggota__table-button-secondary" href="/anggota/detail/'+ value.id +'">Detail</a>'+
										// '<a class="anggota__table-button-success" href="">Edit</a>'+
										// '<button class="anggota__table-button-danger">Delete</button>'+
									'</div>'+
								'</td>'+
							'</tr>'
						);
					});
				}
			});
		}
	</script>
@endsection