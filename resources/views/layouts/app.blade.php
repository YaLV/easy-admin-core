<!DOCTYPE html>

<html class="sv-lightbox-open_" lang="{{ $pageLanguage }}">

<head>
    <title>Svaigi.lv</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="{{ asset("assets/img/favicon.ico") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/jquery-ui.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/owl.carousel.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/font-awesome.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/animate.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/main.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/custom.css") }}">
</head>

<body class="sv-lightbox-open_ sv-has-marketday-dropdown">

{{--@include("frontend.elements.cookies")--}}
@include("frontend.elements.loginpopup")
@include("frontend.elements.mobilemenu")
@include("frontend.elements.marketday")
<div class="sv-dock">
    <div class="container">
        @include("frontend.elements.desktopmenu")
    </div>
</div>
@include("frontend.elements.categorymenu")

@yield('content')

@include("frontend.elements.footer")

@include("frontend.elements.copyright")

<script src="https://maps.googleapis.com/maps/api/js"></script>
<script src="{{ asset("assets/js/jquery-3.1.1.min.js") }}"></script>
<script src="{{ asset("assets/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("assets/js/jquery-ui.min.js") }}"></script>
<script src="{{ asset("assets/js/jquery.ui.touch-punch.min.js") }}"></script>
<script src="{{ asset("assets/js/owl.carousel.min.js") }}"></script>
<script src="{{ asset("assets/js/owl.animate.js") }}"></script>
<script src="{{ asset("assets/js/jquery.selectric.js") }}"></script>
<script src="{{ asset("assets/js/imagesloaded.pkgd.min.js") }}"></script>
<script src="{{ asset("assets/js/svaigi.js") }}?ver={{ filemtime(public_path("assets/js/svaigi.js")) }}"></script>
</body>

</html>
