@extends('layout.v_template')
@section('title', 'Publikasi')

@section('content')
	<div class="publikasi__container">
		<div class="publikasi__head">
			<a class="publikasi__button-primary" href="/publikasi/new">Tambah Gambar</a>
		</div>

		<table class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul</th>
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
									'<a class="publikasi__table-button-secondary" href="/publikasi/detail/'+value.id+'">Detail</a>'+
								'</td>'+
							'</tr>'
						);
					});
				}
			});
		}
	</script>
@endsection