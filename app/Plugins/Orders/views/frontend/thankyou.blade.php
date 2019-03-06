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
                            {!! __('translations.orderCompleteThankYouText') !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div class="vc_row wpb_row vc_row-fluid" style="height: 500px;">
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