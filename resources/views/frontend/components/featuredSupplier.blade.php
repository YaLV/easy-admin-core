
@if($supplier = $frontController->getFeaturedSupplier())
    <div class="sv-farmer-products" style="background-color: #f3f3f3;">
        <div class="container">
            <div class="sv-blank-spacer big"></div>
            <div class="row">
                <div class="intro">
                    <a href="{{ r('supplierOpen', [getSupplierSlugs(language()), __('supplier.slug.'.$supplier->supplier_id)]) }}" class="farmer">
                        <img src="{{ $supplier->supplier->getImageByKey('supplier_image', 'main') }}" />
                        <h3>{{ __("supplier.name.{$supplier->supplier_id}") }}</h3>
                        <h4>{{ __("supplier.location.{$supplier->supplier_id}") }}</h4>
                    </a>
                    <h3><a href="{{ r('supplierOpen', [getSupplierSlugs(language()), __('supplier.slug.'.$supplier->supplier_id)]) }}">{{ $supplier->meta['title'][language()]??"" }}</a></h3>
                    <p>
                        {!! $supplier->meta['description'][language()]??"" !!}
                    </p>
                </div>

                <div class="products">

                    <div class="sv-product-card-slider">
                        <div class="owl-carousel">
                            @foreach($supplier->supplier->products()->pluck('storage_amount','id')->toArray() as $itemId => $itemAmount)
                                @php
                                    $item = $cache->getProduct($itemId);
                                @endphp
                                @include('Products::frontend.listitem')
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <div class="sv-blank-spacer medium"></div>
        </div>
        <div class="bg-static">
            <div class="image" style="background-image: url({{$supplier->getImageByKey('featured_image')}});"></div>
        </div>
    </div>
@endif