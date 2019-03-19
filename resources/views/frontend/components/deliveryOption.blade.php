<div class="sv-delivery-days">
    <div class="container">
        <div class="row">
            <h2>{!! $component->getData('title') !!}</h2>
            <h3>{!! $component->getData('text') !!}</h3>
            <ul>
                @foreach(explode(",", $component->getData('cities')) as $city)
                    <li>{{$city}}</li>
                @endforeach
            </ul>
            <div class="details">
                <div>
                    {!! $component->getData('priceOpt1') !!}
                    {!! $component->getData('priceOpt1desc') !!}
                </div>
                <div>
                    {!! $component->getData('priceOpt2') !!}
                    {!! $component->getData('priceOpt2desc') !!}
                </div>
                <div>
                    {!! $component->getData('priceOpt3') !!}
                    {!! $component->getData('priceOpt3desc') !!}
                </div>
            </div>
        </div>
    </div>
</div>