@extends('layouts.app')

@section('content')
    @include("Orders::frontend.partials.step")

    @include("frontend.elements.profileForm", ['action' => r("profile.save"), 'checkboxText' => _t('translations.iAmLegalPerson'), 'showPassword' => true, 'buttonText' => _t('translations.profileSaveButton')])
@endsection
