@extends('layout.v_template')
@section('title', 'Bendahara')

@section('content')
	<div class="bendahara__container">
		<div class="bendahara__header">
			<div class="bendahara__card">
				<div class="bendahara__card-left">
					<h4>Total Uang Kas</h4>
					<h2 id="cash"></h2>
				</div>
				<i class="fas fa-wallet"></i>
			</div>
			<div class="bendahara__card">
				<div class="bendahara__card-left">
					<h4>Total Pemasukan</h4>
					<h2 id="income"></h2>
				</div>
				<i class="fas fa-arrow-down"></i>
			</div>
			<div class="bendahara__card">
				<div class="bendahara__card-left">
					<h4>Total Pengeluaran</h4>
					<h2 id="spending"></h2>
				</div>
				<i class="fas fa-arrow-up"></i>
			</div>
		</div>

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

		<div class="pagination-container" id="pagination"></div>
	</div>

	<!-- Delete Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 style="text-align: center;">Apa anda yakin ingin menghapus data transaksi?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="handleDelete()">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @include('js/javascript')
	<script type="text/javascript">
		let id = null;
		let numberFormat = new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR"});
		let page = "/transaction";

		$("document").ready(function() {
			showTransactionList();
			showTotalMoney();
		});

		function showTotalMoney() {
			$.ajax({
				type: "GET",
				url: '/transaction/money',
				success: function(result) {
					const cash = $('#cash').html("");
					if (result.totalCash < 0) {
						cash.append(
							'<span style="color: red;">'+numberFormat.format(result.totalCash)+'</span>'
						)
					} else {
						cash.append(numberFormat.format(result.totalCash));
					}
					
					const income = $('#income').html("");
					income.append(numberFormat.format(result.totalIncome));
					
					const spending = $('#spending').html("");
					spending.append(numberFormat.format(result.totalSpending));
				}
			});
		}

		function showTransactionList() {
			$.ajax({
				type: "GET",
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
										'<button class="table-button-danger" type="button" data-toggle="modal" data-target="#delete-modal" data-id="'+value.id+'" onclick="handleSetId(this)">Hapus</button>'+
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
			showTransactionList();
		}

		function handleSetId(e) {
			id = $(e).data('id');
		}

		function handleDelete() {
			$.ajax({
				type: 'POST',
				url: '/api/transaction/delete/' + id,
				success: function(result) {
					$('#delete-modal').modal('hide');
					$('.modal-backdrop').remove();

					showTransactionList();
					showTotalMoney();

					id = null;
				}
			});
		}
	</script>
@endsection