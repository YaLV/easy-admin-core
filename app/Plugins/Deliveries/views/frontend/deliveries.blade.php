@php
    $md = session()->get('marketDay');
    /** @var \App\Plugins\Deliveries\Model\Delivery $deliveries */
    $deliveries = $md->deliveries()->get();
@endphp

@foreach($deliveries as $delivery)
    @php
        /** @var Carbon\Carbon $dt */
        $dt = $md->date->copy();
        $modifiedMD = $dt->addDays($delivery->deliveryTime??0);
        $mdDate = $modifiedMD->format('d');
        $month = __("translations.".$modifiedMD->format('F'));
        $dayName = __("translations.".$modifiedMD->format('l'));
    @endphp
    <div class="tab setDelivery{{ $delivery->id==$cart->delivery_id?" active":"" }}" data-run="{{ r('setDelivery', [$delivery->id]) }}">
        <div class="icon"></div>
        <h3>
            {!! _t('translations.marketDayDeliveryText', ["dayname" => $dayName, 'date' => $mdDate, 'month' => $month]) !!}
        </h3>
        <div class="text">
            <p>
                {!! __("deliveries.description.{$delivery->id}", ['freeAbove' => number_format($delivery->freeAbove,2), 'dayName' => substr($dayName,0, -1)]) !!}
            </p>
            <p>
                <a href="{{ $delivery->addressUrl }}">{{ __("deliveries.address.{$delivery->id}") }}</a>
            </p>
        </div>
        <div class="price">
            {{ $delivery->price }} €
        </div>
    </div>
@endforeach