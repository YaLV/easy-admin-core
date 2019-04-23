@extends('layouts.admin')

@section('content')
    {{--<form action="{{ route($currentRoute.".store",request()->route()->parameters) }}" method="post">--}}
        {{ @csrf_field() }}
        <div class="tab-vertical">
            <div class="row">
                <div class="col-md-2">
                    <ul class="nav nav-tabs nav-pills" id="productTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-toggle="tab"
                               href="#general" role="tab" aria-controls="general"
                               aria-selected="true">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="orderContent-tab" data-toggle="tab"
                               href="#orderContent" role="tab" aria-controls="orderContent"
                               aria-selected="false">Products</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-10">
                    <div class="tab-content" id="productTabContent">
                        <!-- general tabl -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            @foreach($fields as $fieldName => $label)
                                @if($label=='hr')
                                    <div class="row viewRow">
                                        <div class="col-md-12">
                                            <hr style="border:1px solid black;"/>
                                        </div>
                                    </div>
                                    @continue
                                @endif
                                <div class="row viewRow">
                                    <div class="col-md-3"><h5 style="color:#71748d;">{{ $label }}</h5></div>
                                    <div class="col-md-9 vertical-content {{ $canEdit??"" }}">{!! $order->$fieldName !!}</div>
                                </div>
                            @endforeach
                        </div>

                        <!-- product tab -->
                        <div class="tab-pane fade" id="orderContent" role="tabpanel"
                             aria-labelledby="orderContent-tab">
                            @include("Orders::products")
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--@include('admin.partials.formFooter')--}}
    {{--</form>--}}
@endsection

@push('scripts')
    <script src="{{ asset('js/orderlist.js') }}"></script>
@endpush