@extends('layout.v_template')
@section('title', 'Anggota')

@section('content')
    <div class="anggota-detail__container">
        <div class="anggota-detail__card">
            <div class="anggota-detail__group">
                <p>NIK</p>
                <h4 id="nik"></h4>
            </div>
            <div class="anggota-detail__group">
                <p>Nama</p>
                <h4 id="name" style="text-transform: capitalize;"></h4>
            </div>
            <div class="anggota-detail__group">
                <p>Alamat</p>
                <h4 id="address"></h4>
            </div>
            <div class="anggota-detail__group">
                <p>No Hp</p>
                <h4 id="phone"></h4>
            </div>
            <div class="anggota-detail__group">
                <p>Jenis Kelamin</p>
                <h4 id="gender" style="text-transform: capitalize;"></h4>
            </div>

            <a class="button-secondary" href="{{ url()->previous() }}">Kembali</a>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        const memberId = '{{$id}}';
        
        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/member/' + memberId,
                success: function(result) {
                    $('#nik').html(result.data.nik);
                    $('#name').html(result.data.full_name);
                    $('#address').html(result.data.address);
                    $('#phone').html(result.data.phone_number);
                    $('#gender').html(result.data.gender);
                }
            });
        }
    </script>
@endsection