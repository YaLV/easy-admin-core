@extends('layouts.app')

@foreach($suppliers as $supplier)
    @php
        $supplierCache = $cache->getSupplier($supplier);
    @endphp

    @if($supplierCache->isFarmer)
        @push('farmers')
            <a href="{{ r('farmer', [ __("supplier.slug.$supplier")]) }}" class="item">
                <img src="{{ $supplierCache->image(config('app.imageSize.supplier_image.main')) }}">
                <h3>{{ __("supplier.name.$supplier") }}</h3>
                <h4>{{ __("supplier.location.$supplier") }}</h4>
            </a>
        @endpush
        @if($supplierCache->hasCoords())
            @push('farmer-coords')
                ["{{ __("supplier.name.$supplier") }}", {{ $supplierCache->getCoords()[0] }}, {{ $supplierCache->getCoords()[1] }}, {{ $loop->iteration }}, "{{ $supplierCache->image(config('app.imageSize.supplier_image.main')) }}"],
            @endpush
        @endif
    @endif

    @if($supplierCache->isCraftsman)
        @push('craftsman')
            <a href="{{ r('farmer', [__("supplier.slug.$supplier")]) }}" class="item">
                <img src="{{ $supplierCache->image(config('app.imageSize.supplier_image.main')) }}">
                <h3>{{ __("supplier.name.$supplier") }}</h3>
                <h4>{{ __("supplier.location.$supplier") }}</h4>
            </a>
        @endpush
        @if($supplierCache->hasCoords())
            @push('craftsman-coords')
                ["{{ __("supplier.name.$supplier") }}", {{ $supplierCache->getCoords()[0] }}, {{ $supplierCache->getCoords()[1] }}, {{ $loop->iteration }}, "{{ $supplierCache->image(config('app.imageSize.supplier_image.main')) }}"],
            @endpush
        @endif
    @endif

@endforeach



@section('content')
    @include("Orders::frontend.partials.step")

    <div class="sv-page-title-banner">
        <div class="title">
            <h3>produkti no labākajām Latvijas zemnieku saimniecībām</h3>
        </div>
        <div class="bg-parallax has-loaded">
            <div class="image" style="background-image: url({{ asset('assets/img/tmp/photo-2.jpg') }});"></div>
        </div>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div class="vc_row wpb_row vc_row-fluid" style="padding: 0 20%;">
        <div class="wpb_column vc_column_container">
            <div class="vc_column-inner">
                <div class="wpb_wrapper">

                    <div class="sv-text-block">
                        <p>
                            Zemnieku saimniecība Rūķīši no Rencēnu pagasta.<br>
                            Saimniecība Rūķīši ir dibināta 1992. gadā. Saimniecības pamata nodarbošanās ir tradicionālās
                            lauksaimniecības ražošanas nozares - graudkopība un lopkopība.<br> Saimniecība 643 ha
                            bioloģiski sertificētās platībās audzē
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="sv-tabs">
        <div class="container">
            <div class="row">
                <ul class="">
                    <li class="active">
                        <a href="#farmers" class="tab" id="reloadFarmersMarkers">{!! __('translations.suppliers') !!}</a>
                    </li>
                    <li>
                        <a href="#masters" class="tab" id="reloadMastersMarkers">{!! __('translations.craftsmen') !!}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="farmersmap-canvas"></div>

    <div style="background: #f3f3f3;">
        <div class="sv-tab-content">
            <div class="tab-pane fade in active" id="farmers">
                <div class="container">
                    <div class="row">

                        <div class="sv-farmers-list">
                            @stack('farmers')
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="masters">
                <div class="container">
                    <div class="row">

                        <div class="sv-farmers-list">
                            @stack('craftsman')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('preScript')
    <script>
        var farmers = [
            @stack('farmer-coords')
        ];

        var masters = [
            @stack('craftsman-coords')
        ];
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBi1BNqkST_SmY7gsbRxuKZziOyF4ceJB4"></script>
    <script src="{{ asset('assets/js/richmarker-compiled.js') }}">
    </script>
@endpush