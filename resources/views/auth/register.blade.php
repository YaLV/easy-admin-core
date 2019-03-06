@extends('layouts.app')

@section('content')
    @include("frontend.elements.profileForm", ['action' => r("register.post"), 'checkboxText' => 'Reģistrēšos kā juridiska persona', 'showPassword' => true, 'buttonText' => 'Reģistrēties'])
@endsection
