<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panji Saraswati</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
    .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
    .fa-anchor,.fa-coffee {font-size:200px}
    </style>
</head>
<body style="margin: 0;">
    <!-- Header -->
    <div class="header">
        <div class="header-body">
            <div class="header-group">
                <a class="header-link" href="/">PanjiSaraswati</a>
            </div>
            <div class="header-group">
                <a class="header-link" href="/">Beranda</a>
            </div>
            <div class="header-group">
                <a class="header-link" href="">Profil</a>
            </div>
            <div class="header-group">
                <a class="header-link" href="">Dokumen</a>
            </div>
            <div class="header-group">
                <a class="header-link" href="/page/gallery">Galeri</a>
            </div>
            <div class="header-group">
                <a class="header-link" href="">Kontak</a>
            </div>
            <div class="header-group">
                <a class="header-link" href="/login">Log In</a>
            </div>
        </div>
    </div>

    @yield('content')
</body>
</html>