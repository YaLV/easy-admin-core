@foreach($menuItemList as $menuItem)
    @if($menuItem->hasChildren()->where('inMenu', 1)->count())
        @php
            $current = in_array($menuItem->slug,explode("/",url()->current()))??false;
        @endphp
        <li class="nav-item">
            <a class="nav-link{{$current?' active':''}}" href="#" data-toggle="collapse"
               aria-expanded="{{$current?'true':'false'}}" data-target="#{{$menuItem->routeName}}"
               aria-controls="{{$menuItem->routeName}}"><i class="{{$menuItem->icon??''}}"></i>{{$menuItem->displayName}}</a>
            <div id="{{$menuItem->routeName}}" class="collapse submenu{{$current?' show':''}}" style="">
                <ul class="nav flex-column">
                    @include('admin.partials.menu', ['menuItemList' => $menuItem->hasChildren()->where('inMenu', 1)->get()])
                </ul>
            </div>
        </li>
    @else
        @if(($menuItem->action??false) && Route::has($menuItem->routeName))
            <li class="nav-item">
                <a class="nav-link {{ Route::getCurrentRoute()->getName()==$menuItem->routeName?'active':'' }}"
                   href="{{ route($menuItem->routeName) }}">
                    <i class="{{$menuItem->icon}}"></i>{{$menuItem->displayName}}
                </a>
            </li>
        @endif
    @endif
@endforeach