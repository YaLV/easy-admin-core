@php
    $subMenuItems = $menuItem->menuItems??[];
@endphp
<li id="menu_{{$menuItem->id}}">
    <div class="div_menu_button">
        <div class="action">
            <i class="fas fa-minus"></i>
        </div>
        <div class="pull-left title">{{ __("{$menuItem->menu_owner}.name.{$menuItem->owner_id}") }}</div>
        <div class="destroy" data-destroyUrl="{{ route('menus.destroy.item', [$menuItem->id]) }}"><i
                    class="fas fa-trash-alt"></i></div>
    </div>
    @if($subMenuItems)
        <ol>
            @foreach($subMenuItems as $subMenuItem)
                @include("Menu::menuItem", ['menuItem' => $subMenuItem])
            @endforeach
        </ol>
    @endif
</li>