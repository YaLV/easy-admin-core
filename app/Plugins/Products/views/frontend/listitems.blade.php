@extends('Categories::frontend.list')

@section('leftSide')
    @foreach($products as $itemId => $itemAmount)
        @php
            /** @var \App\Cache\ProductCache $item */
            $item = $cache->getProduct($itemId);
            if((!$item->hasManyPrices() && ($itemAmount<1 && !is_null($itemAmount))) || ($item->hasManyPrices() && (!is_null($itemAmount) && $itemAmount<$item->lowestAmount()))) {
                continue;
            }
        @endphp
        @include('Products::frontend.listitem')
    @endforeach
@endsection

@section('wrapper')
    sv-category-wrapper
@endsection