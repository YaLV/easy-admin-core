@php
    $product = $cache->getProduct($item->product_id);
    $random_id = str_random(20);
@endphp
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

<div class="item">
    <div class="product">
        <div class="image">
            <a href="#">
                <img src="{{ asset('assets/img/tmp/photo-20.jpg')}}" />
            </a>
        </div>
        <div class="title">
            <a href="{{ $product->getUrl() }}" class="name">{{ $item->product_name }}</a>
            <a href="#" class="farmer">{{ $item->supplier_name }}</a>
            @stack("variations-$random_id")
        </div>
    </div>
    <div class="price">
        @stack("variations-$random_id")
    </div>
    <div class="quantity">
        <input class="spinner" value="{{ $item->amount }}" />
    </div>
    <div class="total">
        {{ number_format($item->amount*$item->price,2) }} €
    </div>
</div>