
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Panji Saraswati</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    
    <style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
    .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
    .fa-anchor,.fa-coffee {font-size:200px}
    </style>
  </head>
  <body>

  <!-- Navbar -->
  <div class="w3-top" style="position: absolute; z-index: 11;">
    <div class="w3-bar w3-red w3-card w3-left-align w3-large">
      <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
      <a href="/" class="w3-bar-item w3-button w3-padding-large w3-white">Panji Saraswati</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Beranda</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Profil</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Dokumen</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Galeri</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Kontak</a>
      <a href="/login" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Log In</a>
    </div>
  </div>

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

  <div class="main__announ">
    <div class="main__announ-body">
      <h4 id="title">Gotong Royong</h4>
      <p id="date">20-20-2022</p>
      <p id="detail">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem blanditiis laborum reiciendis explicabo veritatis eius doloribus, iste ex ab dicta non odit facilis? Nisi ex natus itaque adipisci beatae consequuntur!</p>
    </div>

    <div class="main__announ-body">
      <h4 id="title">Gotong Royong</h4>
      <p id="date">20-20-2022</p>
      <p id="detail">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem blanditiis laborum reiciendis explicabo veritatis eius doloribus, iste ex ab dicta non odit facilis? Nisi ex natus itaque adipisci beatae consequuntur!</p>
    </div>
  </div>

  </body>

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
</html>