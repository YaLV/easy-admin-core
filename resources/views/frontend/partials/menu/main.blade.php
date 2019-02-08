@php
    $menu = $cache->getMenuCache($menuSlug??"main");
@endphp
@foreach($menu->getItems(($menuId??"first")) as $menuItem)
    <li>
        <a href="{{$menu->getUrl($menuItem)}}"><span>{{  $menu->getName($menuItem) }}</span></a>
    </li>
@endforeach