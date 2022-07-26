@extends('layout.v_template')
@section('title', 'Notulen')

@section('content')
    <div class="notulen__container">
        <div class="notulen__head">
            <a class="notulen__button-primary" href="/notulen/new">Tambah</a>
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
                url: '/note',
                success: function(result) {
                    const el = $('#table-body').html("");
                    result.data.forEach((value, index) => {
                        el.append(
                            '<tr>'+
                                '<td>'+ (index+1) +'</td>'+
                                '<td style="max-width: 500px;">'+ value.title +'</td>'+
                                '<td>'+ value.date +'</td>'+
                                '<td>'+
                                    '<a class="notulen__table-button-secondary" href="/notulen/detail/'+ value.id +'">Detail</a>'+
                                '</td>'+
                            '</tr>'
                        );
                    });
                }
            });
        }
    </script>
@endsection