@extends('layout.v_template')
@section('title', 'Publikasi')

@section('content')
    <div class="publikasi-detail__container">
        <div class="publikasi-detail__card" style="position: relative;">
            <h3 class="publikasi-detail__title"></h3>

            <p class="publikasi-detail__desc"></p>

            <div class="publikasi-detail__image">
                <div class="grid"></div>
            </div>
            
            <a class="button-secondary" href="/publikasi">Kembali</a>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        const galleryId = '{{$id}}';

        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: "GET",
                url: "/gallery/" + galleryId,
                success: function(result) {
                    const image = $('.grid').html("");
                    result.data.gallery_detail.forEach((value, index) => {
                        image.append(
                            '<div class="grid-item">'+
                                '<img style="cursor: pointer;" src="/storage/'+ value.path +'" alt="image'+index+'" data-index="'+index+'" onclick="handleShowButtonDelete(this)">'+
                                '<div class="publikasi-detail__button" id="button-image'+index+'">'+
                                    '<button class="table-button-danger" type="button" data-id="'+value.id+'" onclick="handleDelete(this)">Hapus</button>'+
                                    '<button class="table-button-secondary" type="button" data-index="'+index+'" onclick="handleCloseButtonDelete(this)">Tutup</button>'+
                                '</div>'+
                            '</div>'
                        );
                    });

                    $('.publikasi-detail__title').html(result.data.title);
                    $('.publikasi-detail__desc').html(result.data.desc);
                }
            });
        }

        function handleShowButtonDelete(e) {
            const index = $(e).data('index');

            $('#button-image'+index+'').attr('style', "z-index: 99 !important;")
        }

        function handleCloseButtonDelete(e) {
            const index = $(e).data('index');

            $('#button-image'+index+'').attr('style', "z-index: -1 !important;")
        }

        function handleDelete(e) {
            const id = $(e).data('id');

            $.ajax({
                type: 'POST',
                url: '/api/gallery/delete/image/' + id,
                success: function(result) {
                    showData();
                }
            });
        }
    </script>
@endsection