@php
    /** @var \App\Cache\MenuCache $menu */
    $menu = $cache->getMenuCache($menuSlug??"main");
@endphp

@foreach($menu->getItems(($menuId??"first")) as $menuItem)
    <li>
        <a {{ $menu->hasChildren($menuItem)?"href=# class=next":"href=".$menu->getUrl($menuItem) }}>{{ $menu->getName($menuItem) }}</a>
        @include('frontend.partials.menu.items.mobile', ['menuData' => $menuItem])
    </li>
@endforeach
