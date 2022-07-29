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
    </div>

    <!-- Modal -->
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
                <input class="absen__input-text" type="text" placeholder="Masukkan judul absen" onkeyup="handleChangeName(this)">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="handleSave()">Save changes</button>
            </div>
            </div>
        </div>  
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        let title = "";

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
                url: '/absen/data',
                success: function(result) {
                    const element = $('#table-body').html("");
                    result.data.forEach((value, index) => {
                        const date = new Date(value.created_at);
					    const dateFormat = new Intl.DateTimeFormat(['ban', 'id']).format(date);

                        element.append(
                            '<tr>'+
                                '<td>'+ dateFormat +'</td>'+
                                '<td>'+ value.title +'</td>'+
                                '<td>'+ value.total +' anggota</td>'+
                                '<td>'+
                                    '<a class="table-button-secondary" href="/absen/detail/'+ value.id +'">Open</a>'+
                                '</td>'+
                            '</tr>'
                        );
                    });
                }
            });
        }
    </script>
@endsection