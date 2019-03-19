@extends('layouts.app')

@section('content')
    @foreach($components as $component)
        @php
            $className = "App\\Components\\{$component->component_slug}";
            $class = new $className;
        @endphp
        @includeIf($class->template())
    @endforeach
@endsection