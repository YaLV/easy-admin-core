@php
    /** @var \App\Cache\ProductCache $product */
    $product = $cache->getProduct($item->product_id);
    $random_id = str_random(20);
@endphp


{{--{{ dd($item->currentMarketDayProducts()) }}--}}

@if($product->hasManyPrices())
    @push("variations-$random_id")
        <select name="variation_id" class="selectpicker">
            @foreach($product->prices() as $priceID => $price)
                <option data-wrap="true"
                        value="{{ $priceID }}" {{$item->variation_id==$price->id?"selected":""}} {{ $product->isSale()?"data-origprice={$price->oldPrice}€":"" }}>{{ implode(" / ",[$price->price."€", $price->display_name]) }}</option>
            @endforeach
        </select>
    @endpush
@else
    @push("variations-$random_id")
        <input type="hidden" value="{{$product->prices()->id}}" name="variation_id" />

        @if($product->isSale())
            <s>{{ $product->prices()->oldPrice }}€</s>
        @endif
        {{ implode(" / ",[$product->prices()->price."€", $product->prices()->display_name]) }}
    @endpush
@endif

@if(in_array($cart->market_day_id, $product->marketDays))
    <form>
        <div class="item">
            <input type="hidden" name="product_id" value="{{ $product->id }}" />
            <input type="hidden" name="line" value="{{ $item->id }}" />
            <div class="product">
                <div class="image">
                    <a href="{{ $product->getUrl() }}">
                        <img src="{{ $product->image(config('app.imageSize.product_image.list')) }}"
                             style="max-width:105px;" />
                    </a>
                </div>
                <div class="title">
                    <a href="{{ $product->getUrl() }}" class="name">{{ $item->product_name }}</a>
                    <a href="{{ r('supplierOpen', [getSupplierSlugs(true),__("supplier.slug.{$product->supplier_id}")]) }}"
                       class="farmer">{{ $item->supplier_name }}</a>
                    @stack("variations-$random_id")
                    <a href="{{ r('cart.removeItem', [$item->id]) }}" class="remove discard"></a>
                </div>
            </div>
            <div class="price">
                @stack("variations-$random_id")
            </div>
            <div class="quantity">
                <input class="spinner" name="amount" value="{{ $item->amount }}" />
            </div>
            <div>
                <a href="{{ r('cartAdd') }}" class="updateCartProduct">Update</a>
            </div>
            <div class="total">
                {{ number_format($item->amount*$item->price,2) }} €
            </div>
        </div>
    </form>
@else
    <div class="item is-disabled">
        <div class="product">
            <div class="image">
                <a href="{{ $product->getUrl() }}">
                    <img src="{{ $product->image(config('app.imageSize.product_image.list')) }}"
                         style="max-width:105px;" />
                </a>
            </div>
            <div class="title">
                <a href="{{ $product->getUrl() }}" class="name">{{ $item->product_name }}</a>
                <a href="{{ r('supplierOpen', [getSupplierSlugs(true),__("supplier.slug.{$product->supplier_id}")]) }}"
                   class="farmer">{{ $item->supplier_name }}</a>
                @stack("variations-$random_id")
            </div>
        </div>
        <div class="price">
            @stack("variations-$random_id")
        </div>
        <div class="controls">
            <a href="{{ r('cart.removeItem', [$item->id, 'goTo' => $product->getUrl(false, false)]) }}" class="change">
                <svg width="14px" height="14px">
                    <path d="M14.000,8.000 L8.000,8.000 L8.000,14.000 L6.000,14.000 L6.000,8.000 L0.000,8.000 L0.000,6.000 L6.000,6.000 L6.000,-0.000 L8.000,-0.000 L8.000,6.000 L14.000,6.000 L14.000,8.000 Z"></path>
                </svg>
                <span>{!! _t('translations.replace') !!}</span>
            </a>
            <a href="{{ r('cart.removeItem', [$item->id]) }}" class="discard">
                <svg width="12px" height="12px">
                    <path d="M11.657,1.757 L7.414,6.000 L11.657,10.243 L10.243,11.657 L6.000,7.414 L1.757,11.657 L0.343,10.243 L4.586,6.000 L0.343,1.757 L1.757,0.343 L6.000,4.586 L10.243,0.343 L11.657,1.757 Z"></path>
                </svg>
                <span>{!! _t('translations.refuse') !!}</span>
            </a>
        </div>
    </div>
@endif