@extends('layouts.app')

@section('pageTitle')
    Paldies!
@endsection


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
                            Tavs pasūtījums zemnieku virtuālajā tirgū ir svaigi veikts, un to apstiprinās arī ziņa Tavā e-pastā.<br /><br />
                            Tavs pasūtījums tiks nodots saimniecībām produktu sagatavošanai: vākšanai, lasīšanai, griešanai, šmorēšanai un piegādei.<br /><br />
                            Samaksu par pasūtījumu vari veikt ar pārskaitījumu uz bankas kontu vai skaidrā naudā pasūtījuma saņemšanas brīdī.
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