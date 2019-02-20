@php
    $product = $cache->getProduct($item->product_id);
@endphp
<a href="{{ $product->getUrl() }}" class="item">
    <span class="image">
        <img src="{{ asset('assets/img/tmp/photo-1.jpg') }}">
    </span>
    <span class="text">
        <h3>{{ $item->product_name }}</h3>
        <h4>
            @if($product->isSale())
                <s>{{ $product->getVariationPrice($item->variation_id)->oldPrice }}€</s>
            @endif
            {{ implode(" / ",[$product->getVariationPrice($item->variation_id)->price."€", $product->getVariationPrice($item->variation_id)->display_name]) }} x{{ $item->amount }}
        </h4>
    </span>
</a>