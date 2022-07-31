@extends('layout.v_template')
@section('title', 'Pengumuman')

@section('content')
    <div class="pengumuman__container">
        <div class="pengumuman__head">
            <a class="button-primary" href="/pengumuman/new">Tambah</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <thead id="table-body"></thead>
        </table>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="detail-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pengumuman Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 style="text-align: center;" id="title"></h4>
                    <p style="text-align: center; margin-bottom: 20px;" id="date"></p>
                    <p style="text-align: justify;" id="announ"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
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
                    <h4 style="text-align: center;">Apa anda yakin ingin menghapus data pengumuman?</h4>
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

        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/announ',
                success: function(result) {
                    const el = $('#table-body').html("");
                    result.data.forEach((value, index) => {
                        el.append(
                            '<tr>'+
                                '<td>'+ (index+1) +'</td>'+
                                '<td>'+ value.title +'</td>'+
                                '<td>'+ value.date +'</td>'+
                                '<td>'+
                                    '<button class="table-button-secondary" type="button" data-id="'+value.id+'" data-toggle="modal" data-target="#detail-modal" onclick="handleDetail(this)">Detail</button>'+
                                    '<a class="table-button-success" href="/pengumuman/edit/'+value.id+'">Edit</a>'+
                                    '<button class="table-button-danger" type="button" data-id="'+value.id+'" data-toggle="modal" data-target="#delete-modal" onclick="handleSetId(this)">Hapus</button>'+
                                '</td>'+
                            '</tr>'
                        );
                    });
                }
            });
        }

        function handleDetail(e) {
            const id = $(e).data('id');

            $.ajax({
                type: 'GET',
                url: '/announ/' + id,
                success: function(result) {
                    $('#date').html(result.data.date);
                    $('#title').html(result.data.title);
                    $('#announ').html(result.data.announ);
                }
            });
        }

        function handleSetId(e) {
            id = $(e).data('id');
        }

        function handleDelete() {
            $.ajax({
                type: 'POST',
                url: '/api/announ/delete/' + id,
                success: function(result) {
                    showData();

                    $('#delete-modal').modal('hide');
                }
            });
        }
    </script>
@endsection