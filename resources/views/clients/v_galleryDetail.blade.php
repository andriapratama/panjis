@extends('clients.v_index')

@section('content')
    <div style="margin-top: 100px;">
        <div class="client-gallery-detail__container">
            <div class="client-gallery-detail__card">
                <h3 class="client-gallery-detail__title" id="title"></h3>
    
                <p class="client-gallery-detail__desc" id="desc"></p>
    
                <div class="client-gallery-detail__image">
                    <div class="grid"></div>
                </div>
    
                <a class="button-secondary" href="/page/gallery">Kembali</a>
            </div>
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
                url: '/client/gallery/' + id,
                success: function(result) {
                    $('#title').html(result.data.title);
                    $('#desc').html(result.data.desc);

                    const element = $('.grid').html("");
                    result.data.gallery_detail.forEach((data, index) => {
                        element.append(
                            '<div class="grid-item">'+
                                '<img src="/storage/'+ data.path +'" alt="image'+index+'">'+
                            '</div>'
                        );
                    });
                }
            });
        }
    </script>
@endsection
