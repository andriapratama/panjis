@extends('clients.v_index')

@section('content')
    <div class="client-home">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="main__carousel-logo">
                <img src="/img/angry.png" alt="">
            </div>
            <div class="carousel-inner">
                <div id="carousel-body"></div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    @include('js/javascript')
    <script type="text/javascript">
        const imageList = [
            {
                image: "/storage/uploads/wgDj5iHeXfrlV2PBZR1WWlwj9a3LCMGcTRJQvwEU.jpg"
            },
            {
                image: "/storage/uploads/x3b9y3CvhJq5u9YZfDGyGN9p7rD7ZEIeir4dRaDa.jpg"
            },
            {
                image: "/storage/uploads/wgDj5iHeXfrlV2PBZR1WWlwj9a3LCMGcTRJQvwEU.jpg"
            },
        ];

        $("document").ready(function() {
            showCarousel();
        });

        function showCarousel() {
            const el = $('#carousel-body').html("");
            imageList.forEach((value, index) => {
                if (index === 0) {
                    el.append(
                        '<div class="carousel-item active" style="width: 100%; height: 100vh;">'+
                            '<img class="d-block" src="'+value.image+'" alt="slide'+index+'" style="object-fit: cover; object-position: center; width: 100%; height: 100%;">'+
                        '</div>'
                    );
                } else {
                    el.append(
                        '<div class="carousel-item" style="width: 100%; height: 100vh;">'+
                            '<img class="d-block" src="'+value.image+'" alt="slide'+index+'" style="object-fit: cover; object-position: center; width: 100%; height: 100%;">'+
                        '</div>'
                    );
                }
            });
        }
    </script>
@endsection