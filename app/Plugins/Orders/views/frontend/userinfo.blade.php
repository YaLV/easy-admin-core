@extends('layouts.app')

@section('pageTitle')
    Pircēja Dati
@endsection


@section('content')
    @include("Orders::frontend.partials.step")

    @includeIf("Orders::frontend.partials.".($stepInclude??"noInclude"))

    @include("frontend.elements.profileForm", ['action' => route('checkout.post'.isDefaultLanguage()), 'checkboxText' => 'Pirkumu veikšu kā jurdiska persona', 'showComment' => true, 'buttonText' => 'Nodot pasūtījumu izpildei'])
@endsection