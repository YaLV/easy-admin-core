@if(!in_array($listItem->id, $disabledItems??[]))
    @if(\Route::has($currentRoute.".edit")??false)
        <a href="{{ route($currentRoute.".edit", array_merge(request()->route()->parameters??[], [$listItem->id])) }}"
           class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
    @endif
@endif