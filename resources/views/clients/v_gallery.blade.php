@extends('clients.v_index')

@section('content')
    <div class="client-gallery">
        <div class="client-gallery__body" id="content"></div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        $("document").ready(function() {
            showData();
        });

        function showData() {
            $.ajax({
                type: 'GET',
                url: '/client/gallery',
                success: function(result) {
                    const element = $('#content').html("");
                    result.data.forEach((data, index) => {
                        element.append(
                            '<div class="client-gallery__content">'+
                                '<div class="client-gallery__content-head">'+
                                    '<img src="/storage/'+data.gallery_detail[0].path+'" alt="image'+index+'">'+
                                '</div>'+

                                '<div class="client-gallery__content-body">'+
                                    '<a href="/page/gallery/detail/'+data.id+'"><h4>'+data.title+'</h4></a>'+

                                    '<a href="/page/gallery/detail/'+data.id+'"><p>'+data.desc+'</p></a>'+
                                '</div>'+
                            '</div>'
                        );
                    });
                }
            });
        }
    </script>
@endsection