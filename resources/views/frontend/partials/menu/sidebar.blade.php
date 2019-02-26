@foreach($menuItems as $menuItem)
    {{ dd($menuItem) }}
    <li {{ ($currentMenuId??false)==$menuItem?"class=active":"" }}>
        <a href="{{ r($menuItem['owner'].isDefaultLanguage(), ['category1' => request()->route('category1'), 'category2' => $menuItem['slug']]) }}"><span>{{  $menuItem['name'] }}</span></a>
    </li>
@endforeach