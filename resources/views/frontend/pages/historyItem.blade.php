@extends('layouts.app')

@section('content')
    <div class="sv-order-history">
        <div class="list-open">
            <div class="item current">
                <div class="container">
                    <div class="row">
                        <div class="file">
                            <div>
                                @php
                                    $date = (new \Carbon\Carbon($order->market_day_date))->addDays($order->delivery->deliveryTime);
                                    $md = \App\Plugins\MarketDays\Model\MarketDay::withTrashed()->where('marketDaysSlug', strtolower($date->format('l')))->first();
                                    $mdName = $md->marketDay[language()];
                                @endphp

                                {{ $mdName }}, {{ $date->format('j') }}. {{ __('translations.'.$date->format('F')) }}
                            </div>
                            <div>
                                {!! __("deliveries.description.{$order->delivery->id}", ['freeAbove' => number_format($order->delivery->freeAbove,2), 'dayName' => substr($mdName,0, -1)]) !!}
                            </div>
                        </div>
                        <div class="download">
                            <a href="{{ route('getInvoice', {{$order->invoice}}) }}">{!! _t('translations.downloadInvoice') !!}<span class="icon"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item header">
                <div class="container">
                    <div class="row">
                        <div class="product">
                            {!! _t('translations.cartProducts') !!}
                        </div>
                        <div class="price-single">
                            {!! _t('translations.cartPrice') !!}
                        </div>
                        <div class="quantity">
                            {!! _t('translations.cartQuantity') !!}
                        </div>
                        <div class="price-total">
                            {!! _t('translations.cartSum') !!}
                        </div>
                    </div>
                </div>
            </div>
            @foreach($order->items()->get() as $item)
                <div class="item">
                    <div class="container">
                        <div class="row">
                            <div class="product">
                                <span class="name">{{ $item->product_name }}</span>
                                <span class="farmer">{{ $item->supplier_name }}</span>
                            </div>
                            <div class="price-single">
                                <span>{{ $item->price }} € / {{ $item->display_name }}</span>
                            </div>
                            <div class="quantity">
                                <span>{{ $item->amount }}</span>
                            </div>
                            <div class="price-total">
                                <span>{{ $item->price*$item->amount }} €</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @php
                $cartTotals = getCartTotals($order);
            @endphp
            <div class="item totals">
                <div class="container">
                    <div class="row">
                        <div class="product">
                            <a href="{{ r('recreateCart', [$order->id]) }}" class="repeat"><span class="icon"></span>Atkārtot pirkumu</a>
                        </div>
                        <div class="data-wrapper">
                            <div class="data-row">
                                <div class="type">
                                    {!! _t('translations.cartProducts') !!}
                                </div>
                                <div class="price">
                                    {{ $cartTotals->productSum }} €
                                </div>
                            </div>
                            <div class="data-row">
                                <div class="type">
                                    {!! _t('translations.cartDelivery') !!}
                                </div>
                                <div class="price">
                                    {{$order->delivery_amount}} €
                                </div>
                            </div>
                            @if($order->discount_target??false)
                                <div class="data-row">
                                    <div class="type">
                                        {!! _t('translations.cartDiscount') !!} (<span
                                                style="text-transform: uppercase; font-weight:bold; ">{{$order->discount_code}}</span>)
                                    </div>
                                    <div class="price">
                                        -{{ $cartTotals->discount }} €
                                    </div>
                                </div>
                            @endif
                            <div class="data-row">
                                <div class="type">
                                    {!! _t('translations.cartToPay') !!}
                                </div>
                                <div class="price">
                                    {{ $cartTotals->toPay }} €
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
