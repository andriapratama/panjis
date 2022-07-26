@extends('layout.v_template')
@section('title', 'Notulen')

@section('content')
    <div class="notulen-detail__container">
        <div class="notulen-detail__card">
            <div class="notulen-detail__head">
                <h4 class="notulen-detail__head-title" id="title"></h4>
            </div>

            <div style="display: flex; margin-bottom: 5px">
                <p class="notulen-detail__title">Tanggal <span>:</span></p>
                <p class="notulen-detail__desc" id="date"></p>
            </div>

            <div style="display: flex; margin-bottom: 5px">
                <p class="notulen-detail__title">Jumlah Anggota<span>:</span></p>
                <p class="notulen-detail__desc" id="member"></p>
            </div>

            <div style="display: flex; margin-bottom: 5px">
                <p class="notulen-detail__title">Prihal <span>:</span></p>
                <p class="notulen-detail__desc" id="prihal"></p>
            </div>

            <div style="margin-top: 30px" id="content"></div>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        const id = '{{$id}}';

        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/note/' + id,
                success: function(result) {
                    $('#title').html(result.data.title);
                    $('#date').html(result.data.date);
                    $('#member').html(result.data.total_member);
                    $('#prihal').html(result.data.title);

                    const el = $('#content').html("");
                    let number = 0;
                    result.data.note_detail.forEach((value, index) => {
                        if (value.status === 0) {
                            number = number + 1;
                            el.append(
                                '<div style="display: flex; margin-bottom: 7px">'+
                                    '<p>'+ number +'.</p>'+
                                    '<p style="margin-left: 20px; text-align: justify;">'+value.content+'</p>'+
                                '</div>'
                            );
                        } else if (value.status === 1) {
                            el.append(
                                '<div style="display: flex; margin-bottom: 5px; margin-left: 35px;">'+
                                    '<i class="fas fa-circle" style="font-size: 8px; margin-top: 8px;"></i>'+
                                    '<p style="margin-left: 20px; text-align: justify;">'+value.content+'</p>'+
                                '</div>'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endsection