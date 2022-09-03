@extends('layout.v_template')
@section('title', 'Peminjaman')

@section('content')
    <div class="peminjaman-detail__container">
        <div style="display: block;">
            <div class="peminjaman-detail__card">
                <div class="peminjaman-detail__group">
                    <p>Nama Bidang Humas Dan Pengembangan</p>
                    <h4 id="humas-name"></h4>
                </div>
                <div class="peminjaman-detail__group">
                    <p>Nama Peminjam</p>
                    <h4 id="name"></h4>
                </div>
                <div class="peminjaman-detail__group">
                    <p>Alamat</p>
                    <h4 id="address"></h4>
                </div>
                <div class="peminjaman-detail__group">
                    <p>Tanggal Mulai</p>
                    <h4 id="start-date"></h4>
                </div>
                <div class="peminjaman-detail__group">
                    <p>Tanggal Akhir</p>
                    <h4 id="end-date"></h4>
                </div>
                <div class="peminjaman-detail__group">
                    <p>Status</p>
                    <h4 id="status"></h4>
                </div>
            </div>
    
            <div class="peminjaman-detail__card">
                <h4>Barang yang dipinjam</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="table-body"></tbody>
                </table>
            </div>

            <div style="display: flex;">
                <div id="button"></div>
                <a class="button-secondary" href="{{ url()->previous() }}">Kembali</a>
            </div>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        const loanId = '{{$id}}'
        
        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/loan/' + loanId,
                success: function(result) {
                    $('#humas-name').html(result.loan.humas_name);
                    $('#name').html(result.loan.name);
                    $('#address').html(result.loan.address);
                    $('#start-date').html(result.loan.start_date);
                    $('#end-date').html(result.loan.end_date);
                    
                    const button = $('#button').html("");

                    if (result.loan.status === 0) {
                        $('#status').html("Dipinjam");
                        button.append(
                            '<button class="button-success" type="button" onclick="handleDone()">Selesai</button>'
                        )
                    } else {
                        $('#status').html("Dikembalikan");
                        button.append(
                            '<button class="button-success-disabled" type="button" disabled>Selesai</button>'
                        )
                    }

                    const element = $('#table-body').html("");
                    result.detail.forEach((value, index) => {
                        element.append(
                            '<tr>'+
                                '<td>'+ (index+1) +'</td>'+
                                '<td style="text-transform: capitalize;">'+ value.name +'</td>'+
                                '<td>'+ value.quantity +'</td>'+
                            '</tr>'
                        );
                    });
                }
            });
        }

        function handleDone() {
            $.ajax({
                type: 'POST',
                url: '/api/loan/status/' + loanId,
                success: function(result) {
                    showData();
                }
            });
        }
    </script>
@endsection