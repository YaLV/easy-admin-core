@php
    $menu = $cache->getMenuCache($menuSlug??"main");
    $cmenu = $menu->getItemId(request()->route('slug1'));
@endphp
<option data-wrap="true" data-href="{{ $menu->getUrl($cmenu) }}">{{ $menu->getName($cmenu) }}</option>

@foreach($menu->getItems(($menuId??"first")) as $menuItem)
    <option data-wrap="true" data-href="{{$menu->getUrl($menuItem)}}" {{$menuItem==$menu->getCurrentId()?"selected":""}}>
        {{ $menu->getName($menuItem) }}
    </option>
@endforeach