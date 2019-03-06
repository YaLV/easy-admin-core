@extends('layouts.app')

@section('content')
    @include("Orders::frontend.partials.step")

    @include("frontend.elements.profileForm", ['action' => r("profile.save"), 'checkboxText' => __('translations.iAmLegalPerson'), 'showPassword' => true, 'buttonText' => __('translations.profileSaveButton')])
@endsection
