@php
    $product = $cache->getProduct($item->product_id);
@endphp
<a href="{{ $product->getUrl() }}" class="item">
    <span class="image">
        <img src="{{ $product->image(config('app.imageSize.product_image.list')) }}">
    </span>
    <span class="text">
        <h3>{{ $item->product_name }}</h3>
        <h4>
            @if($product->isSale())
                <s>{{ $product->getVariationPrice($item->variation_id)->oldPrice }}€</s>
            @endif
            {{ implode(" / ",[$item->price."€", $item->display_name]) }} x{{ $item->amount }}
        </h4>
    </span>
</a>