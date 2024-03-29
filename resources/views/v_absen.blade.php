@extends('layout.v_template')
@section('title', 'Absen')

@section('content')
    <div class="absen__container">
        <div class="absen__head">
            <button class="button-primary" type="button" data-toggle="modal" data-target="#add-modal">Tambah</button>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Judul</th>
                    <th>Total Kehadiran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="table-body"></tbody>
        </table>

        <div class="pagination-container" id="pagination"></div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Judul Absen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input class="input-text" type="text" placeholder="Masukkan judul absen" onkeyup="handleChangeName(this)">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="handleSave()">Simpan</button>
            </div>
            </div>
        </div>  
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Judul Absen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input class="input-text" type="text" placeholder="Masukkan judul absen" id="title-edit" onkeyup="handleChangeEditName(this)">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="handleUpdate()">Update</button>
            </div>
            </div>
        </div>  
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        let title = "";
        let id = null;
        let page = "/absen/data";

        $("document").ready(function() {
            showData();
        });

        function handleChangeName(e) {
            const value = $(e).val();

            title = value;
        }

        function handleSave() {
            const formData = new FormData();
            formData.append('title', title);

            $.ajax({
                type: 'POST',
                url: '/api/absent',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    window.location.href = "/absen/new";
                }
            });
        }

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
                            const date = new Date(value.created_at);
                            const dateFormat = new Intl.DateTimeFormat(['ban', 'id']).format(date);
    
                            element.append(
                                '<tr>'+
                                    '<td>'+ dateFormat +'</td>'+
                                    '<td>'+ value.title +'</td>'+
                                    '<td>'+ value.total +' anggota</td>'+
                                    '<td>'+
                                        '<a class="table-button-secondary" href="/absen/detail/'+ value.id +'">Open</a>'+
                                        '<button class="table-button-success" type="button" data-toggle="modal" data-target="#edit-modal" data-id="'+value.id+'" onclick="showDataEdit(this)">Edit Judul</button>'+
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

        function showDataEdit(e) {
            id = $(e).data('id');
            
            $.ajax({
                type: 'GET',
                url: '/absen/title/' + id,
                success: function(result) {
                    title = result.data.title;
                    $('#title-edit').val(result.data.title);
                }
            });
        }

        function handleChangeEditName(e) {
            const value = $(e).val();

            title = value;
        }

        function handleUpdate() {
            const formData = new FormData();
            formData.append('title', title);

            $.ajax({
                type: 'POST',
                url: '/api/absent/update/title/' + id,
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    $('#edit-modal').modal('hide');
					$('.modal-backdrop').remove();
                    
                    showData();
                }
            });
        }
    </script>
@endsection