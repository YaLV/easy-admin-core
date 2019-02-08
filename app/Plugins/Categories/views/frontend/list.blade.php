@extends('layouts.app')

@section('content')
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
