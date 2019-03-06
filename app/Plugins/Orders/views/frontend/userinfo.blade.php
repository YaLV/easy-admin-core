@extends('layouts.app')

@section('content')
    @include("Orders::frontend.partials.step")

    @includeIf("Orders::frontend.partials.".($stepInclude??"noInclude"))

    @include("frontend.elements.profileForm", [
    'action' => r('checkout.post'), 'checkboxText' => __('translations.orderAsLegalPerson'), 'showComment' => true, 'buttonText' => __('translations.proceedToPayments')])
@endsection