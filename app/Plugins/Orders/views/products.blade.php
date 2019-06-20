<div class="row viewRow">
    <div class="col-md-1 checkall">
        <a href="javascript:void(0)">All</a>
    </div>
    <div class="col-md-3"><h5>Product</h5></div>
    <div class="col-md-2"><h5>Variation</h5></div>
    <div class="col-md-1"><h5>Price w/o vat</h5></div>
    <div class="col-md-1"><h5>Vat</h5></div>
    <div class="col-md-1"><h5>Amount</h5></div>
    <div class="col-md-1"><h5>Corrected Amount</h5></div>
    <div class="col-md-1 text-right"><h5>Sum</h5></div>
</div>
@php
    $total = 0;
    $totalVat = $totalWoVat = $vatItems = [];
@endphp

@foreach($items as $item)
    @php
        $product = $item->product;
        $sum = round((($item->price*$item->amount)/$item->total_amount)*$item->real_amount ,2);
        $total+=$sum;
        $vat = round($sum*($item->vat_amount/100),2);
        if(!($totalVat[$item->vat_id]??false)) { $totalVat[$item->vat_id] = 0; }
        if(!($totalWoVat[$item->vat_id]??false)) { $totalWoVat[$item->vat_id] = 0; }
        $totalVat[$item->vat_id]+=$vat;
        $totalWoVat[$item->vat_id]+=$sum-$vat;
        $vatItems[$item->vat_id][] = $item->product_id;
    @endphp
    <div class="row viewRow prodrow">
        <div class="col-md-1">
            <input type="checkbox" name="massAction" value="{{$item->id}}" class="massAction">
        </div>
        <div class="col-md-3">{{ $item->product_name }}
            <br /><sub>{{ __('supplier.name.'.$item->products->supplier_id) }}</sub></div>
        <div class="col-md-2">{{ $item->price }} &euro; / {{ $item->display_name }}</div>

        <div class="col-md-1">{{ ($item->price-$item->vat) }}</div>
        <div class="col-md-1">{{ $item->vat }} ({{ $item->products->vat->amount }}%)</div>

        <div class="col-md-1">{{ $item->amount }} ({{$item->total_amount}} {{$item->amount_unit}})</div>
        <div class="col-md-1">
            @if(!$original)
                <input type="text" class="amountinput" data-origvalue="{{$item->real_amount}}" size="5"
                       name="real_amount" value="{{$item->real_amount}}" /> {{ $item->amount_unit }} <a
                        href='{{route('orders.setAmount', [$order->id, $item->id])}}'
                        class='setCorrectAmount btn btn-xs btn-success invisible'><i class='fas fa-check'></i></a>
            @else
                {{$item->total_amount}} {{$item->amount_unit}}
            @endif
        </div>
        <div class="col-md-1 text-right">{{ number_format($sum,2) }} &euro;</div>
    </div>
@endforeach

@php
    $totalPrices = getCartTotals($order, [], $original);
@endphp


<div class="row viewRow">
    <div class="col-md-12">
        <hr style="border:1px solid black;">
    </div>
</div>

<div class="row viewRow">
    <div class="col-md-9 text-right font-weight-bold">Delivery:</div>
    <div class="col-md-3 text-right">{{ number_format($totalPrices->delivery,2) }} &euro;</div>
</div>


@if($order->discount_target)
    <div class="row viewRow">
        <div class="col-md-9 text-right font-weight-bold">Discount ({{$order->discount_code}}
                                                          - {{ $order->discount_amount }}{!! $order->discount_type=='percent'?"%":"&euro;" !!}
                                                          ):
        </div>
        <div class="col-md-3 text-right">{{ number_format($totalPrices->discount,2) }} &euro;</div>
    </div>
@endif

@foreach($totalVat as $vat_id => $vat_amount)
    @php
        $vatAmount = \App\Plugins\Vat\Model\Vat::find($vat_id)->amount;
        $totals = getCartTotals($order, $vatItems[$vat_id], $original);

        $totalWoVat[$vat_id] = $twv = ($totals->productSum)-$totals->vatSum;
        $totalVat[$vat_id] = $tv = $totals->vatSum;
    @endphp
    <div class="row viewRow">
        <div class="col-md-9 text-right font-weight-bold">Sum w/o VAT ({{ $vatAmount }}%):</div>
        <div class="col-md-3 text-right">{{ number_format($twv,2) }} &euro;</div>
    </div>
    <div class="row viewRow">
        <div class="col-md-9 text-right font-weight-bold">VAT ({{ $vatAmount }}%):</div>
        <div class="col-md-3 text-right">{{ number_format($tv,2) }} &euro;</div>
    </div>
@endforeach

@php
    $sum = array_sum($totalWoVat)+array_sum($totalVat)+$totalPrices->delivery-$totalPrices->discount;
@endphp

<div class="row viewRow">
    <div class="col-md-9 text-right font-weight-bold">Total To Pay:</div>
    <div class="col-md-3 text-right">{{ number_format($sum,2) }} &euro;</div>
</div>
<div class="row viewRow">
    <div class="col-md-9 text-right font-weight-bold">Total Paid:</div>
    <div class="col-md-3 text-right">{{ number_format($order->paidAmountText,2) }} &euro;</div>
</div>
<div class="row viewRow">
    <div class="col-md-9 text-right font-weight-bold">To pay(or return):</div>
    <div class="col-md-3 text-right">{{ number_format($sum-$order->paidAmountText,2) }} &euro;</div>
</div>