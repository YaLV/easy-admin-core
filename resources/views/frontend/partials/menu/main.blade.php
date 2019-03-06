@php
    /** @var \App\Cache\MenuCache $menu */
    $menu = $cache->getMenuCache($menuSlug??"main");
@endphp

@foreach($menu->getItems(($menuId??"first")) as $menuItem)
    <li class="{{ ($currentMenuId??false)==$menuItem?"active":"" }}{{$menu->hasItems($menuItem)?" sv-default-dropdown-toggle":""}}">
        <a href="{{$menu->getUrl($menuItem)}}"><span>{{  $menu->getName($menuItem) }}</span></a>
        <div class="sv-dropdown sv-default-dropdown">
            @foreach($menu->getItems($menuItem) as $subItemID)
                @push('menuItems'.$menuItem)
                    <li class="{{ ($currentMenuId??false)==$subItemID?"active":"" }}">
                        <a href="{{$menu->getUrl($subItemID)}}"><span>{{  $menu->getName($subItemID) }}</span></a>
                    </li>
                @endpush
            @endforeach
            @if($menuImage=$menu->getMenuImage())
                <div class="left">
                    <ul>
                        @stack('menuItems'.$menuItem)
                    </ul>
                </div>
                <div class="right">
                    <div class="bg-static">
                        <div class="image"
                             style="background-image: url({{ asset("assets/img/tmp/photo-15.jpg") }});"></div>
                    </div>
                </div>
            @else
                <ul>
                    @stack('menuItems'.$menuItem)
                </ul>
            @endif
        </div>
    </li>
@endforeach