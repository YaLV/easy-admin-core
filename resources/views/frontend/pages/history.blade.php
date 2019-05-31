@extends('layouts.app')

@section('content')
    <div class="sv-order-history">
        <div class="list">
            @foreach($orders as $order)
                <div class="item">
                    <a href="{{ r('orderhistory', ['orderId' => $order->id]) }}" class="link"></a>
                    <div class="container">
                        <div class="row">
                            <div class="order">
                                <span class="file">{{ $order->invoice }}</span>
                            </div>
                            <div class="day">
                                <span>{{ ($order->order_market_day->marketDay)[language()] }}</span>
                            </div>
                            <div class="date">
                                <span>{{ (new \Carbon\Carbon($order->market_day_date))->format('d.m.Y') }}</span>
                            </div>
                            <div class="price">
                                <span>{{ getCartTotals($order)->toPay }} €</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="sv-blank-spacer medium"></div>
    {{ $orders->onEachSide(3)->render('frontend.elements.orderPagination') }}
@endsection
