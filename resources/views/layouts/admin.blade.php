<!doctype html>
<html lang="{{ session()->get('language')??config('app.fallback_locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title??"Svaigi Admin" }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/multi-select.css')}}">
    <link href="{{ asset('css/circular-std/style.css') }}" rel="stylesheet">
    <link href="{{ mix('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/noty.css') }}">
    <link rel="stylesheet" href="{{ mix('css/custom.css') }}">
    @stack('css')
</head>

<body class="loading">
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
                @if($modalId??false)
                    @foreach($modalId as $modalName => $modalID)
                        @include("admin.elements.modal")
                    @endforeach
                @endif
            </div>
            @include('admin.partials.footer')
        </div>
    </div>
@endif
<script>
    window.token = '{{ csrf_token() }}';
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('//code.jquery.com/ui/1.12.1/jquery-ui.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.js') }}"></script>
<script src="{{ asset('js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('//cloud.tinymce.com/stable/tinymce.min.js') }}?apikey={{env('TINY_KEY',"")}}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
@stack('scripts')
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
    @foreach($errors->all() as $msg)
        @php
            $errorList[] = "<li>$msg</li>";
        @endphp
    @endforeach
    <script>
        jQuery(document).ready(function () {
            svaigi.showMessage("<ul>{!! implode("", $errorList)  !!}</ul>", 'error');
        });
    </script>
@endif
<div class="modalloading"></div>

</body>

</html>