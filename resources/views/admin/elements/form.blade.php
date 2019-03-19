@extends('layouts.admin')

@php
    $tabId = str_random(6);
    $tab = $formElements;
@endphp

@if($errors->any())
    {{ dd($errors->all()) }}
@endif

@section('content')
    <form action="{{ route($currentRoute.".store", request()->route()->parameters) }}" method="post" autocomplete="off">
        {{ @csrf_field() }}
        <div class="card">
            <div class="card-body">
                @if(count($tab['languages']??[])>0)
                    @foreach($tab['languages'] as $languageCode => $language)

                        @push('langTabs')
                            <li class="nav-item">
                                <a class="nav-link {{$loop->first?"active":""}} border-left-0"
                                   id="{{$languageCode}}-simple"
                                   data-toggle="tab" href="#{{$languageCode}}" role="tab"
                                   aria-controls="{{$languageCode}}"
                                   aria-selected="true">{{$language}}</a>
                            </li>
                        @endpush

                        @push('langContent')
                            <div class="tab-pane fade {{$loop->first?"show active":""}}" id="{{$languageCode}}"
                                 role="tabpanel" aria-labelledby="{{$languageCode}}-simple">
                                @foreach($tab['data'] as $name => $element)
                                    @if($element['type']=='view')
                                        @includeIf($element["class"], array_merge($element, ['language' => $languageCode]))
                                        @continue;
                                    @endif
                                    @php
                                        $elementAttr = [];
                                    @endphp
                                    @foreach(($element['dataAttr']??[]) as $dataAttr => $dataValue)
                                        @php
                                            $elementAttr[] = "data-$dataAttr=$dataValue";
                                        @endphp
                                    @endforeach
                                    @include("Admin::fields.".$element["type"], array_merge($element, ["data" => implode(" ", $elementAttr), 'language' => $languageCode]))
                                @endforeach
                            </div>
                        @endpush
                    @endforeach

                    @if(count($tab['languages']??[])>1)
                        <ul class="nav nav-tabs" id="languageTab" role="tablist">
                            @stack('langTabs')
                        </ul>
                        <div class="tab-content" id="languageTabContent">
                            @stack('langContent')
                        </div>
                    @else
                        @stack('langContent')
                    @endif
                @else

                    @foreach($tab['data'] as $name => $element)
                        @if($element['type']=='view')
                            @includeIf($element["class"], $element)
                            @continue;
                        @endif
                        @php
                            $elementAttr = [];
                        @endphp
                        @foreach(($element['dataAttr']??[]) as $dataAttr => $dataValue)
                            @php
                                $elementAttr[] = "data-$dataAttr=$dataValue";
                            @endphp
                        @endforeach
                        @include("Admin::fields.".$element["type"], array_merge($element, ["data" => implode(" ", $elementAttr)]))
                    @endforeach
                @endif
            </div>
        </div>
        @include('admin.partials.formFooter')
    </form>
@endsection