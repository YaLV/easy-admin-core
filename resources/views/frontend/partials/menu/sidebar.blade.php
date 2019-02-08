@foreach($menuItems as $menuItem)
    <li>
        <a href="{{ r($menuItem['owner'].isDefaultLanguage(), ['category1' => request()->route('category1'), 'category2' => $menuItem['slug']]) }}"><span>{{  $menuItem['name'] }}</span></a>
    </li>
@endforeach