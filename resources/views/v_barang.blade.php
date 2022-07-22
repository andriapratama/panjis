@extends('layout.v_template')
@section('title', 'Barang')

@section('content')
    <div class="barang__container">
        <div class="barang__head">
            <a class="barang__button-primary" href="/barang/new">Tambah</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
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
                url: '/product',
                success: function(result) {
                    const element = $('#table-body').html("");
                    result.data.forEach((value, index) => {
                        element.append(
                            '<tr>'+
                                '<td>'+ (index+1) +'</td>'+
                                '<td style="text-transform: capitalize;">'+ value.name +'</td>'+
                                '<td>'+ value.quantity +'</td>'+
                                '<td style="text-transform: capitalize;" >'+ value.unit +'</td>'+
                                '<td>'+
                                    '<a class="barang__table-button-success" href="">Edit</a>'+
                                '</td>'+
                            '</tr>'
                        );
                    });
                }
            });
        }
    </script>
@endsection