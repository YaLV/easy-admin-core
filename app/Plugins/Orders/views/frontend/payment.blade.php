@extends('layouts.app')

@section('content')
    @include("Orders::frontend.partials.step")

    @includeIf("Orders::frontend.partials.".($stepInclude??"noInclude"))

    <form method="post" action="{{ route('payment.post'.isDefaultLanguage()) }}">
        {{ csrf_field() }}
        <button>Pay!</button>
    </form>

@endsection