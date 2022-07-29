@extends('layout.v_template')
@section('title', 'Laporan Penanggung Jawaban')

@section('content')
    <div class="lpj__container">
        <div class="lpj__head">
            <a class="button-primary" href="/lpj/new">Tambah</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Judul</th>
                    <th style="width: 30%;">Aksi</th>
                </tr>
            </thead>
            <tbody id="table-body"></tbody>
        </table>
    </div>

    <!-- Edit Title Modal -->
    <div class="modal fade" id="edit-title" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="input-text" type="text" id="title" placeholder="Masukan Judul Laporan Pertanggung Jawaban" onkeyup="handleChangeTitle(this)">
                    <div id="error-title"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="handleUpdateTitle()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit File Modal -->
    <div class="modal fade" id="edit-file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Judul</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="input-text" type="file" id="file" accept="application/pdf" onchange="handleChangeFile(this)"> 
                    <div id="error-file"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="handleUpdateFile()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        let id = null;
        let title = {value: "", error: false};
        let file = {value: null, error: false};

        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/report',
                success: function(result) {
                    const el = $('#table-body').html("");
                    result.data.forEach((value, index) => {
                        el.append(
                            '<tr>'+
                                '<td>'+ (index+1) +'</td>'+
                                '<td>'+ value.title +'</td>'+
                                '<td>'+
                                    '<button class="table-button-success" data-toggle="modal" data-target="#edit-title" data-id="'+value.id+'" onclick="handleEditTitle(this)">Edit Judul</button>'+
                                    '<button class="table-button-success" data-toggle="modal" data-target="#edit-file" data-id="'+value.id+'" onclick="handleEditFile(this)">Edit File</button>'+
                                    '<a class="table-button-secondary" target="_blank" href="/storage/'+ value.file +'">Lihat PDF</a>'+
                                '</td>'+
                            '</tr>'
                        );
                    });
                }
            });
        }

        function handleEditTitle(e) {
            id = $(e).data('id');

            $.ajax({
                type: 'GET',
                url: '/report/' + id,
                success: function(result) {
                    title.value = result.data.title;

                    $('#title').val(result.data.title);
                }
            });
        }

        function handleChangeTitle(e) {
            const value = $(e).val();

            title.value = value;
            title.error = false;

            $('#error-title').html("");
        }

        function handleUpdateTitle() {
            const titleEl = $('#error-title').html("");
            if (title.value === "") {
                titleEl.append(
                    '<span class="error">Judul LPJ harus diisi</span>'
                )
                title.error = true;
            } else {
                const formData = new FormData();
                formData.append('title', title.value);

                $.ajax({
                    type: 'POST',
                    url: '/api/report/update/title/' + id,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        showData();
                        $('#edit-title').modal('hide');
                    }
                });
            }
        }

        function handleEditFile(e) {
            id = $(e).data('id');
        }

        function handleChangeFile(e) {
            const value = $(e)[0].files[0];

            file.value = value;
            file.error = false;

            $('#error-file').html("");
        }

        function handleUpdateFile() {
            const fileEl = $('#error-file').html("");
            if (file.value === null) {
                fileEl.append(
                    '<span class="error">File LPJ harus diisi</span>'
                )
                file.error = true;
            } else {
                const formData = new FormData();
                formData.append('file', file.value);

                $.ajax({
                    type: 'POST',
                    url: '/api/report/update/file/' + id,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        showData();
                        $('#edit-file').modal('hide');
                    }
                });
            }
        }
    </script>
@endsection