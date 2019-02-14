@extends('Categories::frontend.list')

@section('wrapper')
    sv-product-single-wrapper
@endsection

@section('leftSide')
    <div class="sv-product-single-content">

        <div class="sv-product-single-header">

            <div class="sv-product-description">
                @if($product->isBio)
                    <div class="sv-badge">
                        <img src="{{ asset('assets/img/badge-bio-1.svg') }}">
                    </div>
                @endif
                <img src="{{ $product->image() }}" class="title-image">
                <div class="text">
                    {{ $product->getMeta('description') }}
                </div>
                @if($expire = $product->getMeta('expire_date'))
                    <div class="sv-exp-date">
                        <b>Exp. dat</b>
                        {{$expire}}
                    </div>
                @endif
            </div>

            <div class="sv-product-title">
                <div class="title">
                    <h2>Liellopa gaļa malšanai</h2>
                    <div class="breadcrumbs">
                        @foreach($product->createBreadcrumbs() as $crumb)
                        <a href="{{$crumb['url']}}">{{$crumb['name']}}</a>
                        @endforeach
                    </div>
                    <a href="#" class="farmer">
                        <img src="{{ asset("assets/img/tmp/photo-9.jpg") }}">
                        <h3>{{ __("supplier.name.".$product->supplier_id) }}</h3>
                    </a>
                </div>
                <form action="{{ r("cartAdd".isDefaultLanguage()) }}" method="post">
                    @if($product->hasManyPrices())
                        <select name="variation[{{$product->id}}]" class="selectpicker">
                            @foreach($product->prices() as $priceID => $price)
                                <option value="{{ $priceID }}" {{$loop->first?"selected":""}} {{ $product->isSale()?"data-origprice={$price->oldPrice}€":"" }}>{{ implode(" / ",[$price->price."€", $price->display_name]) }}</option>
                            @endforeach
                        </select>
                    @else
                        <input type="hidden" value="orig" name="variation[{{$product->id}}]" />
                        @if($product->isSale())
                            <s>{{ $product->prices()->oldPrice }}€</s>
                        @endif
                        {{ implode(" / ",[$product->prices()->price."€", $product->prices()->display_name]) }}
                    @endif
                    <button class="sv-btn {{ in_array((new \App\Http\Controllers\CacheController)->getSelectedMarketDay()->id,$product->marketDays)?"":"is-disabled" }}">Pievienot grozam</button>
                </form>
            </div>

        </div>

        <div class="sv-blank-spacer medium"></div>

        <div class="sv-marketday-access">
            <h3>Tirgus dienas, kurās produkts pieejams</h3>
            <p>
                Trigus diena ir diena, uz kuru vari veikt pasūtījumu. Svaigi.lv organizē produktu pasūtījumus no
                saimniecībām uz divām Tirgus dienām nedēļā - Pirmdienu un Ceturtdienu.
            </p>
            <div class="sv-blank-spacer medium"></div>
            <div class="days">
                @foreach($cache->getClosestMarketDayList() as $marketDay)
                    <div class="sv-day {{ in_array($marketDay->id,$product->marketDays)?"":"is-disabled" }}">
                        <div>
                            <div class="nr">
                                <span>{{ $marketDay->date->format('d') }}</span>
                                <span>{{ __(":month", ["month" => $marketDay->date->format('F')]) }}</span>
                            </div>
                            <div class="name">
                                {{ $marketDay->name }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="sv-blank-spacer medium"></div>

        <div class="sv-farmer-about">
            <a href="#" class="farmer">
                <img src="{{ asset("assets/img/tmp/photo-9.jpg") }}">
                <h3>{{ __("supplier.name.".$product->supplier_id) }}</h3>
                <h4>{{ __("supplier.location.".$product->supplier_id) }}</h4>
            </a>
            {{  $product->supplier()->getMeta('description') }}
        </div>

        <div class="sv-blank-spacer medium"></div>



    </div>

@endsection