@extends('layout.v_template')
@section('title', 'Laporan Penanggung Jawaban')

@section('content')
    <div class="lpj__container">
        <div class="lpj__head">
            <a class="lpj__button-primary" href="/lpj/new">Tambah</a>
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
                                    '<a class="lpj__table-button-secondary" target="_blank" href="/storage/'+ value.file +'">Lihat PDF</a>'+
                                '</td>'+
                            '</tr>'
                        );
                    });
                }
            });
        }
    </script>
@endsection