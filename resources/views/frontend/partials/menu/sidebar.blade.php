@foreach($menuItems as $menuItem)
    <li {{ ($currentMenuId??false)==$menuItem?"class=active":"" }}>
        <a href="{{ r($menuItem['owner'], ['category1' => request()->route('category1'), 'category2' => $menuItem['slug']]) }}"><span>{{  $menuItem['name'] }}</span></a>
    </li>
@endforeach