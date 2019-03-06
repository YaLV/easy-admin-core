@extends('Categories::frontend.list')

@php
    $hideHeader = true;
    /** @var \App\Cache\ProductCache $product **/
@endphp

@section('wrapper')
    sv-product-single-wrapper
@endsection

@section('leftSide')
    <div class="sv-product-single-content">

        <div class="sv-product-single-header">

            <div class="sv-product-description">
                @if($product->isBio)
                    <div class="sv-badge">
                        <img src="{{ asset('assets/img/badge-bio-1.svg') }}">
                    </div>
                @endif
                <img src="{{ $product->image(config('app.imageSize.product_image.view')) }}" class="title-image">
                <div class="text">
                    {{ $product->getMeta('description') }}
                </div>
                @if($expire = $product->getMeta('expire_date'))
                    <div class="sv-exp-date">
                        <b>{!! _t('translations.expireDate', ['date' => 1]) !!}</b>
                        {{$expire}}
                    </div>
                @endif
            </div>

            <div class="sv-product-title">
                <div class="title">
                    <h2>{{ __("product.name.{$product->id}") }}</h2>
                    <div class="breadcrumbs">
                        @foreach($product->createBreadcrumbs() as $crumb)
                            <a href="{{$crumb['url']}}">{{$crumb['name']}}</a>
                        @endforeach
                    </div>
                    <a href="#" class="farmer">
                        <img src="{{ asset("assets/img/tmp/photo-9.jpg") }}">
                        <h3>{{ __("supplier.name.".$product->supplier_id) }}</h3>
                    </a>
                </div>
                <form action="{{ r("cartAdd") }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="product_id" value="{{ $product->id }}" />

                    @if($product->hasManyPrices())
                        <select name="variation_id" class="selectpicker" title="variation">
                            @foreach($product->prices() as $priceID => $price)
                                <option value="{{ $priceID }}" {{$loop->first?"selected":""}} {{ $product->isSale()?"data-origprice={$price->oldPrice}€":"" }}>{{ implode(" / ",[$price->price."€", $price->display_name]) }}</option>
                            @endforeach
                        </select>
                    @else
                        <input type="hidden" value="{{$product->prices()->id}}" name="variation_id" />

                        @if($product->isSale())
                            <s>{{ $product->prices()->oldPrice }}€</s>
                        @endif
                        {{ implode(" / ",[$product->prices()->price."€", $product->prices()->display_name]) }}
                    @endif
                    <div class="input-wrapper quantity">
                        <span class="button minus disabled"></span>
                        <span class="button add"></span>
                        <input type="text" name="amount" value="1" class="qty" />
                    </div>
                    <button class="sv-btn {{ in_array((new \App\Http\Controllers\CacheController)->getSelectedMarketDay()->id,$product->marketDays)?"":"is-disabled" }}">
                        {!! _t('translations.addToCart') !!}
                    </button>
                </form>
            </div>

        </div>

        <div class="sv-blank-spacer medium"></div>

        <div class="sv-marketday-access">
            <h3>{!! _t('translations.productMarketDaysAvailableHeader') !!}</h3>
            <p>
                {!! _t('translations.productMarketDaysAvailableText') !!}
            </p>
            <div class="sv-blank-spacer medium"></div>
            <div class="days">
                @foreach($cache->getClosestMarketDayList() as $marketDay)
                    <div class="sv-day {{ in_array($marketDay->id,$product->marketDays)?"":"is-disabled" }}">
                        <div>
                            <div class="nr">
                                <span>{{ $marketDay->date->format('d') }}</span>
                                <span>{{ __(":month", ["month" => $marketDay->date->format('F')]) }}</span>
                            </div>
                            <div class="name">
                                {{ $marketDay->name }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="sv-blank-spacer medium"></div>

        <div class="sv-farmer-about">
            <a href="#" class="farmer">
                <img src="{{ asset("assets/img/tmp/photo-9.jpg") }}">
                <h3>{{ __("supplier.name.".$product->supplier_id) }}</h3>
                <h4>{{ __("supplier.location.".$product->supplier_id) }}</h4>
            </a>
            {{  $product->supplier()->getMeta('description') }}
        </div>

        <div class="sv-blank-spacer medium"></div>
        <div class="sv-title">
            <h3>{!! _t('translations.otherProducts') !!}</h3>
        </div>

        <div class="sv-blank-spacer medium"></div>

        <div class="sv-linked-products-slider">
            <div class="owl-carousel">
                @foreach($product->getOtherProducts($product->id) as $otherProduct)
                    @php
                        $item = $cache->getProduct($otherProduct);
                    @endphp
                    @include("Products::frontend.listitem")
                @endforeach
            </div>
        </div>
    </div>

@endsection