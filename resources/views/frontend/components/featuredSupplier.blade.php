
@if($supplier = $frontController->getFeaturedSupplier())
    <div class="sv-farmer-products" style="background-color: #f3f3f3;">
        <div class="container">
            <div class="sv-blank-spacer big"></div>
            <div class="row">

                <div class="intro">
                    <a href="#" class="farmer">
                        <img src="{{asset('assets/img/tmp/photo-9.jpg')}}" />
                        <h3>{{ __("supplier.name.{$supplier->id}") }}</h3>
                        <h4>{{ __("supplier.location.{$supplier->id}") }}</h4>
                    </a>
                    <h3><a href="#">Svaigi gaļas izstrādājumi, audzēti pēc labākajām BIO tradīcijām</a></h3>
                    <p>
                        {!! $cache->getSupplier($supplier->id)->getMeta('description') !!}
                    </p>
                </div>

                <div class="products">

                    <div class="sv-product-card-slider">
                        <div class="owl-carousel">
                            @foreach($supplier->products()->pluck('id')->toArray() as $itemId)
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
            <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-8.jpg')}});"></div>
        </div>
    </div>
@endif