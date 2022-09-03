@extends('layout.v_template')
@section('title', 'Anggota')

@section('content')
	<div class="anggota__container">
		<div class="anggota__head">
			<a class="button-primary" href="/anggota/new">Tambah</a>
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

		<div class="pagination-container" id="pagination"></div>
	</div>

	@include('js/javascript')
	<script type="text/javascript">
		let page = "/member";

		$("document").ready(function() {
			showData();
		});

		function showData() {
			$.ajax({
				type: 'GET',
				url: page,
				success: function(result) {
					const element = $('#table-body').html("");

					if (result.data.data.length === 0) {
						element.append(
							'<tr>'+
								'<td class="empty-data" colSpan="6">Data Kosong</td>'+
							'</tr>'
						);
					} else {
						result.data.data.forEach((value, index) => {
							element.append(
								'<tr>'+
									'<td>'+ (index+1) +'</td>'+
									'<td>'+ value.nik +'</td>'+
									'<td>'+ value.full_name +'</td>'+
									'<td>'+ value.address +'</td>'+
									'<td>'+ value.phone_number +'</td>'+
									'<td>'+
										'<div class="anggota__table-button">'+
											'<a class="table-button-secondary" href="/anggota/detail/'+ value.id +'">Detail</a>'+
											'<a class="table-button-success" href="/anggota/edit/'+value.id+'">Edit</a>'+
										'</div>'+
									'</td>'+
								'</tr>'
							);
						});
					}

					const el = $('#pagination').html("");
					result.data.links.forEach((value, index) => {
						if (value.url === null) {
							el.append(
								null
							)
						} else {
							if (value.active === true) {
								el.append(
									'<span class="pagination active" data-url="'+value.url+'" onclick="handlePagination(this)">'+value.label+'</span>'
								);
							} else {
								if (value.label === "&laquo; Previous") {
									el.append(
										'<span class="pagination" data-url="'+value.url+'" onclick="handlePagination(this)"><i class="fas fa-chevron-left"></i></span>'
									);
								} else if (value.label === "Next &raquo;") {
									el.append(
										'<span class="pagination" data-url="'+value.url+'" onclick="handlePagination(this)"><i class="fas fa-chevron-right"></i></span>'
									);
								} else {
									el.append(
										'<span class="pagination" data-url="'+value.url+'" onclick="handlePagination(this)">'+value.label+'</span>'
									);
								}
							}
						}
					});
				}
			});
		}

		function handlePagination(e) {
			const url = $(e).data('url');
			page = url;
			showData();
		}
	</script>
@endsection