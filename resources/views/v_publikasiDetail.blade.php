@extends('layout.v_template')
@section('title', 'Publikasi')

@section('content')
    <div class="publikasi-detail__container">
        <div class="publikasi-detail__card">
            <div class="publikasi-detail__image"></div>

            <h3 class="publikasi-detail__title"></h3>

            <p class="publikasi-detail__desc"></p>
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
                    const image = $('.publikasi-detail__image').html("");
                    image.append(
                        '<img src="/storage/'+ result.data.image +'" alt="image">'
                    );

                    $('.publikasi-detail__title').html(result.data.title);
                    $('.publikasi-detail__desc').html(result.data.desc);
                }
            })
        }
    </script>
@endsection