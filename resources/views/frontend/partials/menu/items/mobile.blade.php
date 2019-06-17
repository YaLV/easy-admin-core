@if($menu->hasChildren($menuData))
    <ul>
        @foreach($menu->getItems($menuData) as $subItem)
            <li>
                <a {{ $menu->hasChildren($subItem)?"href=# class=next":"href=".$menu->getUrl($subItem) }}>
                    <span>{{ $menu->getName($subItem) }}</span>
                </a>
                @include('frontend.partials.menu.items.mobile', ['menuData' => $subItem])
            </li>
        @endforeach
    </ul>
@endif
