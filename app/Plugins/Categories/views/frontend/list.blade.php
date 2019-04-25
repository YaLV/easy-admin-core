@extends('layouts.app')

@section('content')

    @if($category??false)
        <div class="sv-products-menu-mobile">
            <select tabindex="-1">
                @include("frontend.partials.menu.mobile", ['menuSlug' => 'shop', 'menuId' => "auto"])
            </select>
        </div>
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
    <form class="sv-sidebar-search is-mobile">
        <input type="text">
        <input type="submit" value="{{ _t('translations.search') }}">
    </form>
    @if(!($hideHeader??false))
        <div class="sv-message">
            <div style="background: #f8ddc4;">
                Izvēlies CETURTDIENU, pirms liec produktus groziņā, ja vēlies pasūtījumu saņemt šajā ceturtdienā, nodod
                to&nbsp;līdz
                plkst. 10:00!<br>
                Ieliec groziņā sezonas ogas&nbsp;vai šīs sezonas medus burciņu! <a href="#">Uzzini vairāk</a>
                <a href="#" class="sv-close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 22 21">
                        <path d="M21.253,19.339l-1.414,1.414L11,11.914,2.161,20.753,0.747,19.339,9.586,10.5,0.747,1.661,2.161,0.247,11,9.086l8.839-8.839,1.414,1.414L12.414,10.5Z"></path>
                    </svg>
                </a>
            </div>
        </div>
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
                        <input type="text" name="search" value="{{request()->get('search')}}" />
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
                                            $attributeValues = $cache->getAttributeCache($attribute)->getValues();
                                        @endphp

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
                                    @endforeach
                                @endif
                            </div>
                            <button class="sv-filters-save">{!! _t('translations.setFilter') !!}</button>
                            <a href="#" class="sv-filters-cancel">{!! _t('translations.clearFilter') !!}</a>
                        </form>
                    @endif
                </div>
                <div class="sv-products">
                    @yield('leftSide')
                </div>
            </div>
        </div>
    </div>
@endsection