@extends('layout.v_template')
@section('title', 'Publikasi')

@section('content')
	<div class="publikasi__container">
		<div class="publikasi__head">
			<a class="button-primary" href="/publikasi/new">Tambah Gambar</a>
		</div>

		<table class="table">
			<thead>
				<tr>
					<th style="width: 5%;">No</th>
					<th>Judul</th>
					<th style="width: 25%;">Aksi</th>
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
				type: "GET",
				url: "/gallery",
				success: function(result) {
					const element = $('#table-body').html("");
					result.data.forEach((value, index) => {
						element.append(
							'<tr>'+
								'<td>' + (index+1) + '</td>'+
								'<td>' + (value.title) + '</td>'+
								'<td>'+
									'<a class="table-button-secondary" href="/publikasi/detail/'+value.id+'">Detail</a>'+
									'<a class="table-button-success" href="/publikasi/edit/'+value.id+'">Edit</a>'+
									'<a class="table-button-success" href="/publikasi/image/'+value.id+'">Tambah Gambar</a>'+
								'</td>'+
							'</tr>'
						);
					});
				}
			});
		}
	</script>
@endsection