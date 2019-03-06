@extends('layouts.app')

@section('content')
    @include("Orders::frontend.partials.step")

    @includeIf("Orders::frontend.partials.".($stepInclude??"noInclude"))

    <form method="post" action="{{ r('payment.post') }}">
        {{ csrf_field() }}
        <button>Pay!</button>
    </form>

@endsection