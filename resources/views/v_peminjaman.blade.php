@extends('layout.v_template')
@section('title', 'Peminjaman')

@section('content')
    <div class="peminjaman__container">
        <div class="peminjaman__head">
            <a class="button-primary" href="/peminjaman/new">Tambah</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="table-body"></tbody>
        </table>

        <div class="pagination-container" id="pagination"></div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        let page = "/loan";

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
                                    '<td>'+ value.name +'</td>'+
                                    '<td>'+ value.start_date +'</td>'+
                                    '<td>'+ value.end_date +'</td>'+
                                    '<td id="status'+index+'"></td>'+
                                    '<td>'+
                                        '<a class="table-button-secondary" href="/peminjaman/detail/'+value.id+'">Detail</a>'+
                                        '<a class="table-button-info" target="_blank" href="/peminjaman/print/'+value.id+'">Print</a>'+
                                    '</td>'+
                                '</tr>'
                            );
    
                            const status = $('#status'+index+'').html("");
                            if (value.status === 0) {
                                status.append(
                                    '<span class="status-danger">Dipinjam</span>'
                                );
                            } else {
                                status.append(
                                    '<span class="status-success">Dikembalikan</span>'
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
			showData();
		}
    </script>
@endsection