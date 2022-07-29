@extends('layout.v_template')
@section('title', 'Bendahara')

@section('content')
	<div class="bendahara__container">
		<div class="bendahara__button">
			<a href="/bendahara/new/in" class="button-primary">Pemasukan</a>
			<a href="/bendahara/new/out" class="button-primary">Pengeluaran</a>
		</div>

		<table class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Judul</th>
					<th>Status</th>
					<th>Total</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody id="table-body"></tbody>
		</table>
	</div>

    @include('js/javascript')
	<script type="text/javascript">
		let numberFormat = new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR"});

		$("document").ready(function() {
			showTransactionList();
		});

		function showTransactionList() {
			$.ajax({
				type: "GET",
				url: "/transaction",
				success: function(result) {
					const element = $('#table-body');
					element.html("");
					result.data.forEach((value, index) => {
						const date = new Date(value.created_at);
						const dateFormat = new Intl.DateTimeFormat(['ban', 'id']).format(date);
						element.append(
							'<tr>'+
								'<td>'+ (index+1) +'</td>'+
								'<td>'+ dateFormat +'</td>'+
								'<td>'+ value.title +'</td>'+
								'<td id="status'+index+'"></td>'+
								'<td>'+ numberFormat.format(value.total) +'</td>'+
								'<td>'+
									'<a href="/bendahara/detail/'+ value.id +'" class="table-button-secondary">Detail</a>'+
									'<a href="/bendahara/edit/'+ value.id +'" class="table-button-success">Edit</a>'+
								'</td>'+
							'</tr>'
						);

						const status = $('#status'+index+'').html("");
						if (value.status === "in") {
							status.append(
								'<div class="status-in-column">Pemasukan</div>'
							);
						} else if (value.status === "out") {
							status.append(
								'<div class="status-out-column">Pengeluaran</div>'
							);
						}
					});
				}
			});
		}
	</script>
@endsection