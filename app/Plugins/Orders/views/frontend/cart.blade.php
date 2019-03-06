@extends('layouts.app')

@section('content')

    @forelse($cart->items as $item)
        @push('items')
            @include("Orders::frontend.partials.item")
        @endpush
    @empty
        @php
            $noItems = true;
        @endphp
    @endforelse

    @php
        $cartTotals = getCartTotals($cart);
    @endphp

    @if(!($noItems??false))

        @includeIf("Orders::frontend.partials.$stepInclude")

        <div class="sv-blank-spacer small"></div>

        <div class="sv-title">
            <h4>{!! __('translations.cartChooseTimeAndType') !!}</h4>
        </div>

        <div class="sv-blank-spacer small"></div>

        @include("Orders::frontend.partials.deliveries")

        <div class="sv-blank-spacer small"></div>

        <div class="sv-cart">
            <div class="list">
                <div class="item header">
                    <div class="product">
                        {!! __('translations.cartProducts') !!}
                    </div>
                    <div class="price">
                        {!! __('translations.cartPrice') !!}
                    </div>
                    <div class="quantity">
                        {!! __('translations.cartQuantity') !!}
                    </div>
                    <div class="total">
                        {!! __('translations.cartSum') !!}
                    </div>
                </div>
                @stack('items')
                <div class="sv-blank-spacer small"></div>
                <div class="coupon">
                    <div class="enter">
                        <input type="text" class="nr" placeholder="{!! __('translations.cartDiscountCode') !!}" />
                    </div>
                    <input type="button" class="sv-btn" value="OK" />
                </div>
            </div>
            <div class="sidebar sticky">
                <div class="totals">
                    <h3>{!! __('translations.cartTotals') !!}</h3>
                    <div class="list">
                        <div class="item">
                            <div>
                                {!! __('translations.cartProducts') !!}
                            </div>
                            <div>
                                {{ $cartTotals->productSum }} €
                            </div>
                        </div>
                        @if($cart->delivery_id)
                            <div class="item">
                                <div>
                                    {!! __('translations.cartDelivery') !!}
                                </div>
                                <div>
                                    {{$cart->delivery_amount}} €
                                </div>
                            </div>
                        @endif
                        @if($cart->discount_target??false)
                            <div class="item">
                                <div>
                                    {!! __('translations.cartDiscount') !!} (<span style="text-transform: uppercase; font-weight:bold; ">{{$cart->discount_code}}</span>)
                                    <a href="#" class="remove"></a>
                                </div>
                                <div>
                                    {{ $cartTotals->discount }} €
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="checkout">
                        <div class="list">
                            <div class="item">
                                <div>
                                    {!! __('translations.cartToPay') !!}
                                </div>
                                <div>
                                    {{ $cartTotals->toPay }} €
                                </div>
                            </div>
                        </div>
                        <a href="{{ r('checkout') }}" class="sv-btn">{!! __('translations.cartFormOrder') !!}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="sv-blank-spacer small"></div>
    @else
        Your Cart is Empty!!
    @endif
@endsection