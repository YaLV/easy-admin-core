@extends('layouts.app')

@section('content')
    <div class="sv-page-title">
        <h2>
            <a href="{{ r('farmer', [__("supplier.slug.{$supplier->id}")]) }}">{{ __("supplier.name.{$supplier->id}") }}</a>
        </h2>
        <h3>
            <a href="{{ r('home') }}">{!! _t('translations.startpage') !!}</a>
            <a href="{{ r('farmers') }}">{!! _t('translations.suppliers') !!}</a>
        </h3>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div class="vc_row wpb_row vc_row-fluid" style="padding: 0 25%;">
        <div class="wpb_column vc_column_container">
            <div class="vc_column-inner">
                <div class="wpb_wrapper">

                    <div class="sv-text-block">
                        <img src="{{ $supplierCache->image(config('app.imageSize.supplier_image.main')) }}" />
                        <br /><br />
                        <p style="font-size: 18px; line-height: 30px;">
                            {{ __("supplier.description.{$supplier->id}") }}
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div class="sv-title">
        <h3>{!! __("translations.products") !!}</h3>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div class="sv-product-card-slider">
        <div class="owl-carousel">
            @foreach($supplier->products as $product)
                @php
                    $item = $cache->getProduct($product->id);
                @endphp
                @include("Products::frontend.listitem")
            @endforeach
        </div>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div id="farmersmap-canvas"></div>
@endsection

@push('preScript')
    <script>
        var farmers = [
            ["{{ __("supplier.name.{$supplier->id}") }}", {{ $supplierCache->getCoords()[0] }}, {{ $supplierCache->getCoords()[1] }}, 1, "{{ $supplierCache->image(config('app.imageSize.supplier_image.main')) }}"],
        ];
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBi1BNqkST_SmY7gsbRxuKZziOyF4ceJB4"></script>
    <script src="{{ asset('assets/js/richmarker-compiled.js') }}">
    </script>
@endpush