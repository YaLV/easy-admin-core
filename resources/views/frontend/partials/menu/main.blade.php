@php
    /** @var \App\Cache\MenuCache $menu */
    $menu = $cache->getMenuCache($menuSlug??"main");
@endphp

@foreach($menu->getItems(($menuId??"first")) as $menuItem)
    <li {{ ($currentMenuId??false)==$menuItem?"class=active":"" }}>
        <a href="{{$menu->getUrl($menuItem)}}"><span>{{  $menu->getName($menuItem) }}</span></a>
    </li>
@endforeach