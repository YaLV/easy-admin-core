@extends('layouts.app')

@section('content')

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
                     style="background-image: url({{ $cache->getCategoryCache()->image(config('app.imageSize.category_image.default'), $currentCategoryId) }}); transform: translateY(-33.6px);"></div>
            </div>
        </div>
    @endif
    <div class="sv-category-title-mobile">
        <h1>Gaļa</h1>
        <a href="#sv-mobile-filters" data-toggle="collapse" class="sv-icon-filter collapsed">
            <s></s>
            <s></s>
        </a>
    </div>
    <div id="sv-mobile-filters" class="sv-mobile-filters panel-collapse collapse">
        <div class="sv-sidebar-filters">
            <div class="item">
                <span data-toggle="collapse" data-target="#filter-1" class="title collapsed">Saimniecības</span>
                <div id="filter-1" class="collapse">
                    <div class="content">
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-1">
                            <label for="check-1">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-2">
                            <label for="check-2">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-3">
                            <label for="check-3">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-4">
                            <label for="check-4">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-5">
                            <label for="check-5">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-6">
                            <label for="check-6">Filtra opcija</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <span data-toggle="collapse" data-target="#filter-2" class="title collapsed">Filtrs</span>
                <div id="filter-2" class="collapse">
                    <div class="content">
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-11">
                            <label for="check-11">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-22">
                            <label for="check-22">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-33">
                            <label for="check-33">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-44">
                            <label for="check-44">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-55">
                            <label for="check-55">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-66">
                            <label for="check-66">Filtra opcija</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <span data-toggle="collapse" data-target="#filter-3" class="title collapsed">Otrs filtrs</span>
                <div id="filter-3" class="collapse">
                    <div class="content">
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-111">
                            <label for="check-111">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-222">
                            <label for="check-222">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-333">
                            <label for="check-333">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-444">
                            <label for="check-444">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-555">
                            <label for="check-555">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-666">
                            <label for="check-666">Filtra opcija</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <span data-toggle="collapse" data-target="#filter-4" class="title collapsed">Trešais filtrs</span>
                <div id="filter-4" class="collapse">
                    <div class="content">
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-1111">
                            <label for="check-1111">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-2222">
                            <label for="check-2222">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-3333">
                            <label for="check-3333">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-4444">
                            <label for="check-4444">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-5555">
                            <label for="check-5555">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-6666">
                            <label for="check-6666">Filtra opcija</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <span data-toggle="collapse" data-target="#filter-5" class="title collapsed">Pēdejais filtrs</span>
                <div id="filter-5" class="collapse">
                    <div class="content">
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-11111">
                            <label for="check-11111">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-22222">
                            <label for="check-22222">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-33333">
                            <label for="check-33333">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-44444">
                            <label for="check-44444">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-55555">
                            <label for="check-55555">Filtra opcija</label>
                        </div>
                        <div class="input-wrapper checkbox">
                            <input type="checkbox" id="check-66666">
                            <label for="check-66666">Filtra opcija</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="sv-sidebar-search is-mobile">
        <input type="text">
        <input type="submit" value="Search">
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
                    <ul class="menu">
                        @include("frontend.partials.menu.main", ['menuSlug' => 'shop', 'menuId' => "auto"])
                    </ul>
                    <form class="sv-sidebar-search">
                        <input type="text" />
                        <input type="submit" value="Search" />
                    </form>
                    <div class="sv-sidebar-filters">
                        <div class="item">
                            <span data-toggle="collapse" data-target="#filter-1"
                                  class="title collapsed">Saimniecības</span>
                            <div id="filter-1" class="collapse">
                                <div class="content">
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-1" />
                                        <label for="check-1">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-2" />
                                        <label for="check-2">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-3" />
                                        <label for="check-3">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-4" />
                                        <label for="check-4">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-5" />
                                        <label for="check-5">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-6" />
                                        <label for="check-6">Filtra opcija</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <span data-toggle="collapse" data-target="#filter-2" class="title collapsed">Filtrs</span>
                            <div id="filter-2" class="collapse">
                                <div class="content">
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-11" />
                                        <label for="check-11">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-22" />
                                        <label for="check-22">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-33" />
                                        <label for="check-33">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-44" />
                                        <label for="check-44">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-55" />
                                        <label for="check-55">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-66" />
                                        <label for="check-66">Filtra opcija</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <span data-toggle="collapse" data-target="#filter-3"
                                  class="title collapsed">Otrs filtrs</span>
                            <div id="filter-3" class="collapse">
                                <div class="content">
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-111" />
                                        <label for="check-111">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-222" />
                                        <label for="check-222">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-333" />
                                        <label for="check-333">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-444" />
                                        <label for="check-444">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-555" />
                                        <label for="check-555">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-666" />
                                        <label for="check-666">Filtra opcija</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <span data-toggle="collapse" data-target="#filter-4" class="title">Trešais filtrs</span>
                            <div id="filter-4" class="collapse in">
                                <div class="content">
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-1111" />
                                        <label for="check-1111">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-2222" />
                                        <label for="check-2222">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-3333" />
                                        <label for="check-3333">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-4444" />
                                        <label for="check-4444">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-5555" />
                                        <label for="check-5555">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-6666" />
                                        <label for="check-6666">Filtra opcija</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <span data-toggle="collapse" data-target="#filter-5"
                                  class="title collapsed">Pēdejais filtrs</span>
                            <div id="filter-5" class="collapse">
                                <div class="content">
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-11111" />
                                        <label for="check-11111">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-22222" />
                                        <label for="check-22222">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-33333" />
                                        <label for="check-33333">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-44444" />
                                        <label for="check-44444">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-55555" />
                                        <label for="check-55555">Filtra opcija</label>
                                    </div>
                                    <div class="input-wrapper checkbox">
                                        <input type="checkbox" id="check-66666" />
                                        <label for="check-66666">Filtra opcija</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="sv-filters-cancel">Notīrīt filtru</a>
                </div>

                <div class="sv-products">
                    @yield('leftSide')
                </div>
            </div>
        </div>
    </div>
@endsection
