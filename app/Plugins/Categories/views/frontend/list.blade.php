@extends('layouts.app')

@php
    /** @var \App\Plugins\Categories\Model\Category $category */
@endphp

@section('content')

    @if($category??false)
        @if(!($hideHeader??false))
            <div class="sv-category-title-banner">
                <div class="title">
                    <h3>{{ __("category.name.$currentCategoryId") }}</h3>
                    <h4>{{ __("category.description.$currentCategoryId") }}</h4>
                </div>
                <div class="bg-parallax has-loaded">
                    <div class="image"
                         style="background-image: url({{ $cache->getCategoryCache()->image(config('app.imageSize.category_image.default'), $currentCategoryId) }});"></div>
                </div>
            </div>
        @endif
        <div class="sv-category-title-mobile">
            <h1>{{ __("category.name.$currentCategoryId") }}</h1>
            <a href="#sv-mobile-filters" data-toggle="collapse" class="sv-icon-filter collapsed">
                <s></s>
                <s></s>
            </a>
        </div>
    @endif
    <div id="sv-mobile-filters" class="sv-mobile-filters panel-collapse collapse">
        <div class="sv-sidebar-filters">
            <div class="item">
                <span data-toggle="collapse" data-target="#filter-1-m"
                      class="title collapsed">{!! _t('translations.suppliers') !!}</span>
                <div id="filter-1-m" class="collapse">
                    <div class="content">
                        @foreach($suppliers as $supplier)
                            <div class="input-wrapper checkbox">
                                <input type="checkbox" id="check-{{$supplier}}-m">
                                <label for="check-{{$supplier}}-m">{{ __('supplier.name.'.$supplier) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="sv-sidebar-search is-mobile" method="get" action="{{ r('url', ['search']) }}">
        <input type="text" name="search" value="{{ request()->get('search') }}" title="search">
        <input type="submit" value="{{ _t('translations.search') }}">
    </form>
    @if($banners??false)
        @foreach($banners as $banner)
            @if($banner->type!='message')
                @continue
            @endif
            @if($banner->frequency=='always' || ($banner->frequency=='once_per_session' && !session()->has('banner'.$banner->id)) || ($banner->frequency=='once_a_week' && !request()->cookie('banner'.$banner->id)))
                @push('css')
                    <style type="text/css">
                        .sv-message#message-{{$banner->id}}     {
                            color: #{{$banner->color_text}};
                        }

                        .sv-message#message-{{$banner->id}}    > div {
                            background-color: #{{ $banner->color_background }};
                        }

                        .sv-message#message-{{$banner->id}} a {
                            color: #{{$banner->color_url }};
                        }
                    </style>
                @endpush
                <div class="sv-message" id="message-{{ $banner->id }}">
                    <div>
                        {{ $banner->meta['message'][language()] }}
                        <a href="#" class="sv-close reportClose" data-url="{{ route('closeBanner', [$banner->id]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 22 21">
                                <path d="M21.253,19.339l-1.414,1.414L11,11.914,2.161,20.753,0.747,19.339,9.586,10.5,0.747,1.661,2.161,0.247,11,9.086l8.839-8.839,1.414,1.414L12.414,10.5Z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
    <div class="@yield('wrapper')">
        <div class="container">
            <div class="row">
                <div class="sv-sidebar-category">
                    @if($category??false)
                        @if(request()->route('slug2'))
                            <a href="{{ r('url', ['slug1' => request()->route('slug1')]) }}"
                               class="sv-back-link">{{ __('category.name.'.$categoryPath[request()->route('slug1')]['id']??"") }}</a>
                        @elseif(request()->route('slug3'))
                            <a href="{{ r('url', ['slug1' => request()->route('slug1'),'slug2' => request()->route('slug2')]) }}"
                               class="sv-back-link">{{__('category.name.'.$categoryPath[request()->route('slug2')]['id']??"")}}</a>
                        @endif
                        <ul class="menu">
                            @include("frontend.partials.menu.main", ['menuSlug' => 'shop', 'menuId' => "auto"])
                        </ul>
                    @endif
                    <form class="sv-sidebar-search" method="get" action="{{ r('url', ['search']) }}">
                        <input type="text" name="search" value="{{request()->get('search')}}" title="search" />
                        <input type="submit" value="{{ _t('translations.search') }}" />
                    </form>

                    @if($category??false)
                        <form method="post" action="{{ route('setFilter', [$category->id]) }}">
                            {{ csrf_field() }}
                            @php
                                $in="";
                                $open="collapsed";
                                $currentSuppliers = getCurrentSuppliers($category->id);
                                if(count($currentSuppliers)>0) {
                                    $in = "in";
                                    $open = "";
                                }
                            @endphp
                            <div class="sv-sidebar-filters">
                                <div class="item">
                            <span data-toggle="collapse" data-target="#filter-supp"
                                  class="title {{$open}}">Saimniecības</span>
                                    <div id="filter-supp" class="collapse {{$in}}">
                                        <div class="content">
                                            @foreach($suppliers as $supplier)
                                                <div class="input-wrapper checkbox">
                                                    <input type="checkbox" id="check-{{$supplier}}-supp"
                                                           name="suppliers[]"
                                                           {{ in_array($supplier, $currentSuppliers)?"checked":"" }} value="{{$supplier}}">
                                                    <label for="check-{{$supplier}}-supp">{{ __('supplier.name.'.$supplier) }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @if($category??false)
                                    @php
                                        $currentAttributes = getCurrentAttributes($category->id);
                                    @endphp
                                    @foreach($cache->getCategoryCache()->getFilters($category->id) as $attribute)
                                        @php
                                            $open = false;
                                            $attributeValues = $cache->getAttributeCache($attribute)->getAvailableValues();
                                        @endphp

                                        @if($attributeValues)
                                            @push('filter-'.$attribute)
                                                @foreach($attributeValues as $attributeValue)
                                                    @php
                                                        $checked = in_array($attributeValue,$currentAttributes)?"checked":"";

                                                        $open = ($checked||($open??null))?true:null;
                                                    @endphp
                                                    <div class="input-wrapper checkbox">
                                                        <input type="checkbox" id="check-{{$attributeValue}}"
                                                               class="filterValue"
                                                               name="filter[]"
                                                               value="{{$attributeValue}}" {{ $checked }}/>
                                                        <label for="check-{{$attributeValue}}">{{ __('attributevalues.name.'.$attributeValue) }}</label>
                                                    </div>
                                                @endforeach
                                            @endpush

                                            <div class="item">
                                <span data-toggle="collapse" data-target="#filter-{{ $attribute }}"
                                      class="title {{ ($open?"":"collapsed") }}">{{ __('attributes.name.'.$attribute) }}</span>
                                                <div id="filter-{{ $attribute }}" class="collapse {{ $open?"in":"" }}">
                                                    <div class="content">
                                                        @stack('filter-'.$attribute)
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <button class="sv-filters-save sv-btn">{!! _t('translations.setFilter') !!}</button>
                            </div>
                            @if($filters??false)
                                <a href="{{ route('setFilter', ['reset']) }}"
                                   class="sv-filters-cancel">{!! _t('translations.clearFilter') !!}</a>
                            @endif
                        </form>
                    @endif
                </div>
                <div class="sv-products">
                    @if(count($products??[]) || ($product??false))
                        @yield('leftSide')
                    @else
                        {!! _t('translations.nothinghasbeenfound') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection