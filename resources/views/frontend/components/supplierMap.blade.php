@foreach(\App\Plugins\Suppliers\Model\Supplier::all()->pluck('id') as $supplier)
    @php
        $supplierCache = $cache->getSupplier($supplier);
    @endphp

    @if($supplierCache->isFarmer)
        @push('farmers')
            <a href="{{ r('supplierOpen', [__("pages.slug.{$page->id}"), __("supplier.slug.$supplier")]) }}" class="item">
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
            <a href="{{ r('supplierOpen', [__("pages.slug.{$page->id}"), __("supplier.slug.$supplier")]) }}" class="item">
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

<div class="sv-tabs">
    <div class="container">
        <div class="row">
            <ul class="">
                <li class="active">
                    <a href="#farmers" class="tab" id="reloadFarmersMarkers">{!! _t('translations.suppliers') !!}</a>
                </li>
                <li>
                    <a href="#masters" class="tab" id="reloadMastersMarkers">{!! _t('translations.craftsmen') !!}</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div id="farmersmap-canvas"></div>

<div class="sv-farmers-wrapper">
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
