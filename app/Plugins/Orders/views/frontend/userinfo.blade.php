@extends('layouts.app')

@section('content')
    @include("Orders::frontend.partials.step")

    @includeIf("Orders::frontend.partials.".($stepInclude??"noInclude"))
    @php
        $cart->isOriginal = true;
    @endphp
    @include("frontend.elements.profileForm", [
    'action' => r('checkout.post'), 'checkboxText' => _t('translations.orderAsLegalPerson'), 'showComments' => true, 'buttonText' => _t('translations.proceedToPayments')])
@endsection