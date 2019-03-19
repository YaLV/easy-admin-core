
<div class="sv-product-card-slider">
    <div class="owl-carousel">
        @foreach(\App\Plugins\Products\Model\Product::where(['is_highlighted' => 1])->pluck('id')->toArray() as $itemId)
            @php
                $item = $cache->getProduct($itemId);
            @endphp
            @include('Products::frontend.listitem')
        @endforeach

    </div>
</div>