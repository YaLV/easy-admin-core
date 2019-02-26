@extends('layouts.app')

@section('pageTitle')
    Profils
@endsection

@section('content')
    @include("Orders::frontend.partials.step")

    @include("frontend.elements.profileForm", ['action' => r("profile.save".isDefaultLanguage()), 'checkboxText' => 'Esmu Juridiska persona', 'showPassword' => true, 'buttonText' => 'Saglabāt'])
@endsection
