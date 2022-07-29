@extends('layout.v_template')
@section('title', 'Bendahara')

@section('content')
    <div class="bendahara-detail__container">
        <div class="bendahara-detail__head">
            <div class="bendahara-detail__head-group">
                <p style="width: 70px;">Judul</p>
                <span id="title"></span>
            </div>

            <div class="bendahara-detail__head-group">
                <p style="width: 70px;">Tanggal</p>
                <span id="date"></span>
            </div>

            <div class="bendahara-detail__head-group">
                <p style="width: 70px;">Status</p>
                <span id="status"></span>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th style="width: 10%;">No</th>
                    <th>Name</th>
                    <th style="width: 30%;">Sub Total</th>
                </tr>
            </thead>
            <tbody id="table-body"></tbody>
            <tbody>
                <th colSpan="2">Total</th>
                <td id="total"></td>
            </tbody>
        </table>

        <a class="button-secondary" href="{{ url()->previous() }}">Kembali</a>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        const transactionId = '{{$id}}';
		let numberFormat = new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR"});
        
        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/transaction/' + transactionId,
                success: function(result) {
                    const date = new Date(result.data.created_at);
                    $('#title').html(": " + result.data.title);
                    $('#date').html(": " + new Intl.DateTimeFormat(['ban', 'id']).format(date));
                    if (result.data.status === "in") {
                        $('#status').html(": Pemasukan"); 
                    } else {
                        $('#status').html(": Pengeluaran"); 
                    }
                    $('#total').html(numberFormat.format(result.data.total));

                    const element = $('#table-body');
                    element.html("");
                    result.data.transaction_detail.forEach((value, index) => {
                        element.append(
                            '<tr>'+
                                '<td>'+ (index+1) +'</td>'+
                                '<td>'+ value.name +'</td>'+
                                '<td>'+ numberFormat.format(value.sub_total) +'</td>'+
                            '</tr>'
                        );
                    })
                }
            });
        }
    </script>
@endsection