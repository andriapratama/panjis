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
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/loan',
                success: function(result) {
                    const element = $('#table-body').html("");
                    result.data.forEach((value, index) => {
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
            });
        }
    </script>
@endsection