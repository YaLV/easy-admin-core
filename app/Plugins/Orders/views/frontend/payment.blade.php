@extends('layouts.app')

@php
    /** @var \App\Plugins\Orders\Model\OrderHeader $cart */
    $cartTotals = getCartTotals($cart);

    /** @var Carbon\Carbon $dt */
    $dt = \Carbon\Carbon::createFromTimeString($cart->market_day_date);
    $delivery = $cart->delivery;
    $modifiedMD = $dt->addDays($delivery->deliveryTime??0);
    $mdDate = $modifiedMD->format('j');
    $month = __("translations.".$modifiedMD->format('F'));
    $dayName = __("translations.".$modifiedMD->format('l'));

@endphp

@section('content')
    @include("Orders::frontend.partials.step")

    @includeIf("Orders::frontend.partials.".($stepInclude??"noInclude"))


    <div class="sv-payment">
        <h3>
            <div class="container">{!! _t('translations.selectPaymentAndPay') !!} </div>
        </h3>
        <div class="col-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="payment-cards">
                           <a href="{{ r('paysera.make') }}">
                                <h4>{!! _t('translations.payWithCard') !!}</h4>
                                <span><img src="img/icon-visa.png" class="visa"></span>
                            </a>

                            <a href="#" class="payWithMoney">
                                <h4>{!! _t('translations.payWithCash') !!}</h4>
                                <span>{!! _t('translations.payWithCashDesc') !!}</span>
                            </a>
                            {{--
                                                        <a href="#">
                                                            <h4>Ar dāvanu karti</h4>
                                                            <span>Apmaksa uz vietas, saņemot preci</span>
                                                        </a>
                            --}}
                            @if($user->is_legal)
                                <a href="#" class="pay" data-paymentType="invoice">
                                    <h4>{!! _t('translations.payWithInvoice') !!}</h4>
                                    <span>{!! _t('translations.payWithInvoiceDesc') !!}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="summary">
                            <h3>
                                {!! _t('translations.purchase') !!}
                                <a href="{{ r('cart') }}">
                                    <svg width="25px" height="25px">
                                        <path d="M23.381,1.617 C21.229,-0.540 17.729,-0.540 15.577,1.617 L1.269,15.922 C1.157,16.034 1.088,16.178 1.067,16.332 L0.007,24.185 C-0.025,24.409 0.055,24.632 0.209,24.787 C0.342,24.920 0.529,25.000 0.715,25.000 C0.747,25.000 0.779,25.000 0.811,24.995 L5.541,24.355 C5.935,24.302 6.212,23.940 6.159,23.546 C6.106,23.151 5.744,22.874 5.349,22.928 L1.557,23.439 L2.297,17.962 L8.061,23.727 C8.194,23.860 8.380,23.940 8.567,23.940 C8.753,23.940 8.940,23.865 9.073,23.727 L23.381,9.422 C24.425,8.378 25.000,6.993 25.000,5.517 C25.000,4.041 24.425,2.656 23.381,1.617 ZM15.854,3.375 L18.256,5.778 L5.200,18.836 L2.798,16.433 L15.854,3.375 ZM8.572,22.203 L6.223,19.854 L19.279,6.796 L21.628,9.145 L8.572,22.203 ZM22.630,8.117 L16.882,2.369 C17.612,1.767 18.523,1.436 19.481,1.436 C20.573,1.436 21.596,1.862 22.369,2.630 C23.141,3.397 23.562,4.425 23.562,5.517 C23.562,6.481 23.231,7.387 22.630,8.117 Z"></path>
                                    </svg>
                                </a>
                            </h3>
                            <div class="content">
                                <div class="totals">
                                    <div class="heading">
                                        <span>{!! _t('translations.cartProducts') !!}</span>
                                        <span>{{ $cartTotals->productSum }} €</span>
                                    </div>
                                    <div>
                                        <span>{!! _t('translations.cartDelivery') !!}</span>
                                        <span>{{ $cart->delivery_amount }} €</span>
                                    </div>
                                    {{--<div>
                                        <span>Apmaksātais ar dāvanu karti <a href="#" class="remove"></a></span>
                                        <span>0.99 €</span>
                                    </div>--}}
                                    {{--<div>
                                        <span>Apmaksātais ar dāvanu karti <a href="#" class="remove"></a></span>
                                        <span>0.99 €</span>
                                    </div>--}}
                                    @if($cart->discount_target??false)
                                        <div>
                                            <span>{!! _t('translations.cartDiscount') !!}</span>
                                            <span>{{ $cartTotals->discount }} €</span>
                                        </div>
                                    @endif
                                    <div>
                                        <span>{!! _t('translations.toPay') !!}</span>
                                        <span>{{ $cartTotals->toPay }} €</span>
                                    </div>
                                </div>
                            </div>
                            <h3>
                                {!! _t('translations.deliveryInformation') !!}
                                <a href="{{ r('checkout', ['edit']) }}">
                                    <svg width="25px" height="25px">
                                        <path d="M23.381,1.617 C21.229,-0.540 17.729,-0.540 15.577,1.617 L1.269,15.922 C1.157,16.034 1.088,16.178 1.067,16.332 L0.007,24.185 C-0.025,24.409 0.055,24.632 0.209,24.787 C0.342,24.920 0.529,25.000 0.715,25.000 C0.747,25.000 0.779,25.000 0.811,24.995 L5.541,24.355 C5.935,24.302 6.212,23.940 6.159,23.546 C6.106,23.151 5.744,22.874 5.349,22.928 L1.557,23.439 L2.297,17.962 L8.061,23.727 C8.194,23.860 8.380,23.940 8.567,23.940 C8.753,23.940 8.940,23.865 9.073,23.727 L23.381,9.422 C24.425,8.378 25.000,6.993 25.000,5.517 C25.000,4.041 24.425,2.656 23.381,1.617 ZM15.854,3.375 L18.256,5.778 L5.200,18.836 L2.798,16.433 L15.854,3.375 ZM8.572,22.203 L6.223,19.854 L19.279,6.796 L21.628,9.145 L8.572,22.203 ZM22.630,8.117 L16.882,2.369 C17.612,1.767 18.523,1.436 19.481,1.436 C20.573,1.436 21.596,1.862 22.369,2.630 C23.141,3.397 23.562,4.425 23.562,5.517 C23.562,6.481 23.231,7.387 22.630,8.117 Z"></path>
                                    </svg>
                                </a>
                            </h3>
                            <div class="content">
                                <div class="totals">
                                    <div class="heading-big">
                                        <span>{!! _t('translations.marketDayDeliveryText', ["dayname" => $dayName, 'date' => $mdDate, 'month' => $month]) !!}</span>
                                    </div>
                                    @if($delivery->type=='delivery')
                                        <div class="heading-small">
                                            <span>{!! _t('translations.deliveryAddress') !!}</span>
                                        </div>
                                        <div>
                                            <span>{{ $user->address }}, {{ $user->postal_code }}</span>
                                        </div>
                                        @else
                                        <div class="heading-small">
                                            <span>{!! _t('translations.collectAtWarehouse') !!}</span>
                                        </div>
                                        <div>
                                            <span>{{ __('deliveries.address.'.$delivery->id) }}</span>
                                        </div>
                                    @endif
                                    @if($cart->delivery_comment)
                                        <div class="heading-small">
                                            <span>{!! _t('translations.checkoutComments') !!}</span>
                                        </div>
                                        <div>
                                            <span>{{ $cart->delivery_comment }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="content">
                                <div class="totals">
                                    <div>
                                        <span>{!! _t('translations.profileFormEmail') !!}</span>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                    <div>
                                        <span>{!! _t('translations.profileFormPhone') !!}</span>
                                        <span>{{ $user->phone }}</span>
                                    </div>
                                    <div class="notes">
                                        <span>{{ $user->address_comments }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form method="post" action="{{ r('payment.post') }}" class="hidden payForm">
        {{ csrf_field() }}
        <input type="hidden" name="payment_type" id="payment_type" value="money" />
    </form>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.pay').click(function (e) {
                e.preventDefault();
                $('#payment_type').val($(this).data('paymenttype'));
                $('.payForm').submit();
                return false;
            });
        });
    </script>
@endpush