@extends('layouts.app')

@section('pageTitle')
    Reģistrācija
@endsection

@section('content')
    @include("Orders::frontend.partials.step")

    @include("frontend.elements.profileForm", ['action' => r("register.post".isDefaultLanguage()), 'checkboxText' => 'Reģistrēšos kā juridiska persona', 'showPassword' => true, 'buttonText' => 'Reģistrēties'])
@endsection
