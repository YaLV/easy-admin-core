@extends('Categories::frontend.list')

@section('leftSide')
    @foreach($products as $itemId)
        @php
            $item = $cache->getProduct($itemId);
        @endphp
        @include('Products::frontend.listitem')
    @endforeach
@endsection

@section('wrapper')
    sv-category-wrapper
@endsection