<!DOCTYPE html>

<html>

<head>
    <title>Svaigi.lv</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
</head>

<body class="sv-404">

<div class="sv-404">
    <div class="logo">
        <a href="{{ r('page') }}"><img src="{{asset('assets/img/logo-svaigilv-1.svg')}}" /></a>
    </div>
    <div class="title">
        <h2>404</h2>
        <h3>{!! _t('translations.thispagenotfound') !!}</h3>
        <div class="sv-blank-spacer medium"></div>
        <a href="{{ r('page') }}" class="sv-btn">{!! _t('translations.gohome') !!}</a>
    </div>
    <div class="bg-static">
        <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-18.jpg')}});"></div>
    </div>
</div>
<script src="{{asset('assets/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('js/trans.js')}}" class=""></script>
</body>

</html>
