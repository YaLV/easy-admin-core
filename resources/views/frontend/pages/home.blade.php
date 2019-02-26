@extends('layouts.app')

@section('content')
    <div class="sv-page-title-banner">
        <div class="title">
            <h3>Svaigi produkti tieši no zemniekiem</h3>
            <h4>ar piegāde līdz pat mājām</h4>
        </div>
        <div class="bg-parallax">
            <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-2.jpg')}});"></div>
        </div>
    </div>

    <div class="sv-image-banner">
        <div class="item">
            <a href="#" class="link"></a>
            <div class="title">
                <h3>Vasaras baudas</h3>
            </div>
            <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-3.jpg')}});"></div>
            <div class="sizing"></div>
        </div>
        <div class="item">
            <a href="#" class="link"></a>
            <div class="title">
                <h3>Oranžās garšas</h3>
            </div>
            <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-4.jpg')}});"></div>
            <div class="sizing"></div>
        </div>
    </div>

    <div class="sv-blank-spacer small"></div>

    <div class="sv-title">
        <h3>Populāri</h3>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div class="sv-product-card-slider">
        <div class="owl-carousel">
            @foreach(\App\Plugins\Products\Model\Product::where(['is_highlighted' => 1])->pluck('id')->toArray() as $itemId)
                @php
                    $item = $cache->getProduct($itemId);
                @endphp
                @include('Products::frontend.listitem')
            @endforeach

        </div>
    </div>

    @if($supplier)
    <div class="sv-blank-spacer medium"></div>

    <div class="sv-farmer-products" style="background-color: #f3f3f3;">
        <div class="container">
            <div class="sv-blank-spacer big"></div>
            <div class="row">

                <div class="intro">
                    <a href="#" class="farmer">
                        <img src="{{asset('assets/img/tmp/photo-9.jpg')}}" />
                        <h3>{{ __("supplier.name.{$supplier->id}") }}</h3>
                        <h4>{{ __("supplier.location.{$supplier->id}") }}</h4>
                    </a>
                    <h3><a href="#">Svaigi gaļas izstrādājumi, audzēti pēc labākajām BIO tradīcijām</a></h3>
                    <p>
                        {!! $cache->getSupplier($supplier->id)->getMeta('description') !!}
                    </p>
                </div>

                <div class="products">

                    <div class="sv-product-card-slider">
                        <div class="owl-carousel">
                            @foreach($supplier->products()->pluck('id')->toArray() as $itemId)
                                @php
                                    $item = $cache->getProduct($itemId);
                                @endphp
                                @include('Products::frontend.listitem')
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <div class="sv-blank-spacer medium"></div>
        </div>
        <div class="bg-static">
            <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-8.jpg')}});"></div>
        </div>
    </div>
    @endif

    <div class="sv-blank-spacer medium"></div>

    <div class="sv-title">
        <h3>Noderīgi</h3>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div class="sv-blog-list">
        <div class="container">
            <div class="row">
                <div class="item">
                    <a href="#" class="link"></a>
                    <div class="title">
                        <h2>Vasarā baudi tēju aukstu!</h2>
                    </div>
                    <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-10.jpg')}});"></div>
                    <div class="sizing"></div>
                </div>
                <div class="item">
                    <a href="#" class="link"></a>
                    <div class="title">
                        <h2>Kā kopt baziliku podiņā</h2>
                    </div>
                    <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-11.jpg')}});"></div>
                    <div class="sizing"></div>
                </div>
                <div class="item">
                    <a href="#" class="link"></a>
                    <div class="title">
                        <h2>Kā pareizi sasaldēt ogas un augļus</h2>
                    </div>
                    <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-12.jpg')}});"></div>
                    <div class="sizing"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="sv-blank-spacer medium"></div>

    <div class="sv-steps">
        <div class="sv-blank-spacer medium"></div>
        <div class="sv-title">
            <h3>Kā tas notiek</h3>
            <p>
                Zemnieki produktus piegādā 2x nedeļē, tāpēc pirms uzsāc iepirkšanos, izvēlies dienu uz kuru gribēsi saņemt savus produktus.
            </p>
        </div>
        <div class="sv-blank-spacer medium"></div>
        <div class="container">
            <div class="row">
                <div class="item">
                    <div class="nr">
                        <span>1</span>
                    </div>
                    <h3>Izvēlies tirgus dienu</h3>
                    <p>
                        Zemnieki produktus piegādā 2x nedeļē, tāpēc pirms uzsāc iepirkšanos, izvēlies dienu uz kuru gribēsi saņemt savus produktus.
                    </p>
                </div>
                <div class="item">
                    <div class="nr">
                        <span>2</span>
                    </div>
                    <h3>Iepērcies, kā jebkurā internetveikalā</h3>
                    <p>
                        Zemnieki produktus piegādā 2x nedeļā, tāpēc pirms uzsāc iepirkšanos, izvēlies dienu uz kuru gribēsi saņemt savus produktus.
                    </p>
                </div>
                <div class="item">
                    <div class="nr">
                        <span>3</span>
                    </div>
                    <h3>Saņem svaigus produktus pie mums vai ar piegādi</h3>
                    <p>
                        Zemnieki produktus piegādā 2x nedeļā, tāpēc pirms uzsāc iepirkšanos, izvēlies dienu uz kuru gribēsi saņemt savus produktus.
                    </p>
                </div>
            </div>
        </div>
        <div class="sv-blank-spacer big"></div>
        <div class="bg-parallax">
            <div class="image" style="background-image: url({{asset('assets/img/tmp/photo-2.jpg')}});"></div>
        </div>
    </div>    
@endsection