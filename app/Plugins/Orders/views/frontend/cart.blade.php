@extends('layouts.app')

@section('pageTitle')
    Grozs
@endsection

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
        @include("Orders::frontend.partials.step")

        @includeIf("Orders::frontend.partials.$stepInclude")

        <div class="sv-blank-spacer small"></div>

        <div class="sv-title">
            <h4>Izvēlies produktu saņemšanas laiku un veidu:</h4>
        </div>

        <div class="sv-blank-spacer small"></div>

        @include("Orders::frontend.partials.deliveries")

        <div class="sv-blank-spacer small"></div>

        <div class="sv-cart">
            <div class="list">
                <div class="item header">
                    <div class="product">
                        Produkti
                    </div>
                    <div class="price">
                        Cena
                    </div>
                    <div class="quantity">
                        Daudzums
                    </div>
                    <div class="total">
                        Summa
                    </div>
                </div>
                @stack('items')
                <div class="sv-blank-spacer small"></div>
                <div class="coupon">
                    <div class="enter">
                        <input type="text" class="nr" placeholder="Tev ir akcijas kods?" />
                    </div>
                    <input type="button" class="sv-btn" value="OK" />
                </div>
            </div>
            <div class="sidebar sticky">
                <div class="totals">
                    <h3>Kopsavilkums</h3>
                    <div class="list">
                        <div class="item">
                            <div>
                                Produkti
                            </div>
                            <div>
                                {{ $cartTotals->productSum }} €
                            </div>
                        </div>
                        @if($cart->delivery_id)
                            <div class="item">
                                <div>
                                    Piegāde
                                </div>
                                <div>
                                    {{$cart->delivery_amount}} €
                                </div>
                            </div>
                        @endif
                        @if($cart->discount_target??false)
                            <div class="item">
                                <div>
                                    Atlaide (<span style="text-transform: uppercase; font-weight:bold; ">{{$cart->discount_code}}</span>)
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
                                    Kopā apmaksai
                                </div>
                                <div>
                                    {{ $cartTotals->toPay }} €
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('checkout'.isDefaultLanguage()) }}" class="sv-btn">Noformēt pasūtījumu</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="sv-blank-spacer small"></div>
    @else
        Your Cart is Empty!!
    @endif
@endsection