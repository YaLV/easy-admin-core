
<div class="sv-product-card-slider">
    <div class="owl-carousel">
        @foreach(\App\Plugins\Products\Model\Product::where(['is_highlighted' => 1])->pluck('storage_amount','id')->toArray() as $itemId => $itemAmount)
            @php
                $item = $cache->getProduct($itemId);
            @endphp
            @include('Products::frontend.listitem')
        @endforeach

    </div>
</div>