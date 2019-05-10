@php
/** @var \App\Cache\ProductCache $item */
@endphp
<div class="sv-product-card {{ $item->isSale() }}">
    <form method="post" action="{{ r("cartAdd") }}">
        {{ @csrf_field() }}
        <input type="hidden" name="product_id" value="{{ $item->id }}" />
        @if($item->isSale())
            <div class="sv-tag sale">
                {!! _t('translations.sale') !!}
            </div>
        @elseif($item->isSuggested)
            <div class="sv-tag sugg">
                {!! _t('translations.suggested') !!}
            </div>
        @elseif($item->isNew())
            <div class="sv-tag new">
                {!! _t('translations.new') !!}
            </div>
        @endif

        <a href="{{ $item->getUrl() }}" class="image" style="background-image: url({{ $item->image(config('app.imageSize.product_image.list')) }});">
            <div class="sizing"></div>
        </a>
        <div class="text">
            <h2><a href="{{ $item->getUrl() }}">{{ __("product.name.{$item->id}") }}</a></h2>
            @if($item->hasManyPrices())
                <select name="variation_id" class="selectpicker">
                    @foreach($item->prices() as $priceID => $price)
                        <option data-wrap="true" {{ $item->isAvailable($priceID, $itemAmount)?"":"disabled" }}
                                value="{{ $priceID }}" {{$loop->first?"selected":""}} {{ $item->isSale()?"data-origprice={$price->oldPrice}€":"" }}>{{ implode(" / ",[$price->price."€", $price->display_name]) }}</option>
                    @endforeach
                </select>
            @else
                <h3>
                    <input type="hidden" value="{{ $item->prices()->id }}" name="variation_id" />
                    @if($item->isSale())
                        <s>{{ $item->prices()->oldPrice }}€</s>
                    @endif
                    {{ implode(" / ",[$item->prices()->price."€", $item->prices()->display_name]) }}
                </h3>
            @endif
            <h4><a href="{{ r('supplierOpen', [getSupplierSlugs(true),__("supplier.slug.{$item->supplier_id}")]) }}">{{ __("supplier.name.{$item->supplier_id}") }}</a></h4>
        </div>
        <button class="add-to-cart">
                <span class="icon">
                    <s></s>
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="14" viewBox="0 0 26 14">
                        <path d="M25.91,2l0.081,0.046L21,13.538V14H6l-0.806-.014L0.009,2.046,0.09,2H0V0H26V2H25.91ZM2.234,2L6.577,12H19.423L23.766,2H2.234Z"></path>
                    </svg>
                </span>
        </button>
    </form>
</div>