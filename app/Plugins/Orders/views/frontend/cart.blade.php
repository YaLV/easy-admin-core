@extends('layouts.app')

@section('content')
    @forelse($cart->items(true)->get() as $item)
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
            <h4>{!! _t('translations.cartChooseTimeAndType') !!}</h4>
        </div>

        <div class="sv-blank-spacer small"></div>

        @include("Orders::frontend.partials.deliveries")

        <div class="sv-blank-spacer small"></div>

        <div class="sv-cart">
            <div class="list">
                <div class="item header">
                    <div class="product">
                        {!! _t('translations.cartProducts') !!}
                    </div>
                    <div class="price">
                        {!! _t('translations.cartPrice') !!}
                    </div>
                    <div class="quantity">
                        {!! _t('translations.cartQuantity') !!}
                    </div>
                    <div class="total">
                        {!! _t('translations.cartSum') !!}
                    </div>
                </div>
                @stack('items')
                <div class="sv-blank-spacer small"></div>
                <div class="coupon">
                    <form method="post" action="{{ r('addDiscountCode') }}" id="discountCodeForm">
                        <div class="enter">
                            {{ @csrf_field() }}
                            <input type="text" name="code" class="nr enderDiscountCode"
                                   placeholder="{!! __('translations.cartDiscountCode') !!}" value="{{ $cart->discount_code }}" />
                        </div>
                        <input type="submit" class="sv-btn" value="OK" />
                    </form>
                </div>
            </div>
            <div class="sidebar sticky">
                <div class="totals">
                    <h3>{!! _t('translations.cartTotals') !!}</h3>
                    <div class="list">
                        <div class="item">
                            <div>
                                {!! _t('translations.cartProducts') !!}
                            </div>
                            <div class="productSum">
                                {{ $cartTotals->productSum }} €
                            </div>
                        </div>
                        <div class="item" {{ $cart->delivery_id?"":"style=display:none;" }}>
                            <div>
                                {!! _t('translations.cartDelivery') !!}
                            </div>
                            <div class="delivery">
                                {{$cart->delivery_amount}} €
                            </div>
                        </div>
                        <div class="item" {{ $cart->discount_code?"":"style=display:none;" }}>
                            <div>
                                {!! _t('translations.cartDiscount') !!} (<span
                                        style="text-transform: uppercase; font-weight:bold; " class="dcode">{{$cart->discount_code}}</span>)
                                <a href="{{ r('removeDiscountCode') }}" class="remove" id="removeDiscountCode"></a>
                            </div>
                            <div class="discount">
                                {{ $cartTotals->discount }} €
                            </div>
                        </div>
                    </div>
                    <div class="checkout">
                        <div class="list">
                            <div class="item">
                                <div>
                                    {!! _t('translations.cartToPay') !!}
                                </div>
                                <div class="toPay">
                                    {{ $cartTotals->toPay }} €
                                </div>
                            </div>
                        </div>
                        <a href="{{ r('checkout') }}" class="sv-btn">{!! _t('translations.cartFormOrder') !!}</a>
                    </div>
                </div>
                <div class="clear">
                    <a href="{{ route('clearCart') }}"
                       class="sv-filters-cancel">{!! _t('translations.clearCart') !!}</a>
                </div>
            </div>
        </div>

        <div class="sv-blank-spacer small"></div>
    @else
        Your Cart is Empty!!
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/cart.js') }}"></script>
@endpush