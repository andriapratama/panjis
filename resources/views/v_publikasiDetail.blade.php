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
            
            <a class="button-secondary" href="{{ url()->previous() }}">Kembali</a>
        </div>
    </div>

    @include('js/javascript')
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
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
                        console.log(value);
                        image.append(
                            '<div class="grid-item">'+
                                '<img src="/storage/'+ value.path +'" alt="image'+index+'">'+
                            '</div>'
                        );
                    });

                    setTimeout(() => {
                        $('.grid').masonry({
                            itemSelector: '.grid-item',
                        });
                    }, 100);

                    $('.publikasi-detail__title').html(result.data.title);
                    $('.publikasi-detail__desc').html(result.data.desc);
                }
            })
        }
    </script>
@endsection