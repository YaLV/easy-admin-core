@extends('layouts.admin')

@foreach($formElements as $tab)
    @php
        $tabId = str_random(6);
        $tabData = $tabContentData = [];
    @endphp

    @foreach(($tab['dataAttr']['tab']??[]) as $dataAttr => $dataValue)
        @php
            $tabData[] = "data-$dataAttr='$dataValue'";
        @endphp
    @endforeach

    @foreach(($tab['dataAttr']['tab-content']??[]) as $dataAttr => $dataValue)
        @php
            $tabContentData[] = "data-$dataAttr='$dataValue'";
        @endphp
    @endforeach


    @push('tabs')
        <li class="nav-item">
            <a class="nav-link {{$loop->first?"active":""}}" id="{{ $tab['id']??$tabId }}-tab" data-toggle="tab"
               href="#{{ $tab['id']??$tabId }}" role="tab" aria-controls="{{ $tab['id']??$tabId }}"
               aria-selected="true" {{ implode(" ", $tabData) }}>{{ $tab['Label'] }}</a>
        </li>
    @endpush

    @push('tabContent')
        <div class="tab-pane fade {{$loop->first?"show active":""}}" id="{{ $tab['id']??$tabId }}" role="tabpanel"
             aria-labelledby="{{ $tab['id']??$tabId }}-tab" {{ implode(" ", $tabContentData) }}>

            @if(count($tab['languages']??[])>0)
                @foreach($tab['languages'] as $languageCode => $languageName)
                    @push('langTabs-'.($tab['id']??$tabId))
                        <li class="nav-item">
                            <a class="nav-link {{$loop->first?"active":""}} border-left-0"
                               id="{{$languageCode}}-simple{{($tab['id']??$tabId)}}"
                               data-toggle="tab" href="#{{$languageCode}}{{($tab['id']??$tabId)}}" role="tab"
                               aria-controls="{{$languageCode}}{{($tab['id']??$tabId)}}"
                               aria-selected="true">{{$languageName}}</a>
                        </li>
                    @endpush

                    @push('langContent-'.($tab['id']??$tabId))
                        <div class="tab-pane fade {{$loop->first?"show active":""}}"
                             id="{{$languageCode}}{{($tab['id']??$tabId)}}"
                             role="tabpanel" aria-labelledby="{{$languageCode}}-simple{{($tab['id']??$tabId)}}">
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
                                @includeIf("Admin::fields.".$element["type"], array_merge($element, ["data" => implode(" ", $elementAttr), 'language' => $languageCode]))
                            @endforeach
                        </div>
                    @endpush
                @endforeach

                @if(count($tab['languages']??[])>1)
                    <ul class="nav nav-tabs" id="languageTab" role="tablist">
                        @stack('langTabs-'.($tab['id']??$tabId))
                    </ul>
                    <div class="tab-content" id="languageTabContent">
                        @stack('langContent-'.($tab['id']??$tabId))
                    </div>
                @else
                    @stack('langContent-'.($tab['id']??$tabId))
                @endif
            @else

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

                    @include("Admin::fields.".$element["type"], array_merge($element, ["data" => implode(" ", $elementAttr)]))
                @endforeach
            @endif
        </div>
    @endpush
@endforeach




@section('content')

    <form action="{{ Route::has($currentRoute.".store")?route($currentRoute.".store",request()->route()->parameters):"" }}" method="post">
        {{ @csrf_field() }}
        <div class="tab-vertical">
            <div class="row">
                <div class="col-md-2">
                    <ul class="nav nav-tabs nav-pills" id="productTab" role="tablist">
                        @stack('tabs')
                    </ul>
                </div>
                <div class="col-md-10">
                    <div class="tab-content" id="productTabContent">
                        @stack('tabContent')
                    </div>
                </div>
            </div>
        </div>
        @include('admin.partials.formFooter')
    </form>
@endsection