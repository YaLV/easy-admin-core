@extends('layouts.app')

@section('content')
    @include("Orders::frontend.partials.step")

    @includeIf("Orders::frontend.partials.".($stepInclude??"noInclude"))

    <div class="sv-blank-spacer medium"></div>

    <div class="vc_row wpb_row vc_row-fluid" style="padding: 0 25%;">
        <div class="wpb_column vc_column_container">
            <div class="vc_column-inner">
                <div class="wpb_wrapper">

                    <div class="sv-text-block">
                        <p style="font-size: 18px; line-height: 30px;">
                            @if($paymentMethod == 'paysera')
                                {!! _t('translations.orderPaymentProcessingText') !!}
                            @else
                                {!! _t('translations.orderCompleteThankYouText') !!}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div class="vc_row wpb_row vc_row-fluid sv-thankyou-image">
        <div class="wpb_column vc_column_container">
            <div class="vc_column-inner">
                <div class="wpb_wrapper">
                    <div class="bg-parallax">
                        <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-19.jpg')}});"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if($paymentMethod == 'paysera')
    @push('scripts')
        <script>
            var payseraInterval;
            $(document).ready(function () {
                payseraInterval = setInterval(function(){
                    $.get('{{ route('paysera.success') }}', function( data ) {
                        if(data) {
                            clearInterval(payseraInterval);
                            $('.sv-text-block p').html('{!! str_replace( array( "\n", "\r" ), array( "\\n", "\\r" ), _t("translations.orderCompleteThankYouText") ) !!}');
                        }
                    });
                }, 500);
            });
        </script>
    @endpush
@endif
