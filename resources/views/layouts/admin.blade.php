<!doctype html>
<html lang="{{ session()->get('language')??config('app.fallback_locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title??"Svaigi Admin" }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="{{ asset('css/circular-std/style.css') }}" rel="stylesheet">
    <link href="{{ mix('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/fontawesome-all.css') }}">
    @stack('css')
</head>

<body>
@if(!Auth::user()??false)
    @yield('content')
@else
    <div class="dashboard-main-wrapper">
        @include('admin.partials.navbar')
        @include('admin.partials.sidebar')
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                @include('admin.partials.pageLabel')
                @yield('content')
            </div>
            @include('admin.partials.footer')
        </div>
    </div>
@endif
<script>
    window.token = '{{ csrf_token() }}';
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    jQuery('select').select2();
</script>
@if(session('message'))
    @php
        $message = session('message');
    @endphp
    <script>
        jQuery(document).ready(function () {
            svaigi.showMessage("{{$message['msg']}}", '{{ ($message['isError']??false)?'error':'success' }}');
        });
    </script>
@endif
@if($errors->any())
    <script>
        jQuery(document).ready(function () {
            svaigi.showMessage("There was an error", 'error');
        });
    </script>
@endif

</body>

</html>