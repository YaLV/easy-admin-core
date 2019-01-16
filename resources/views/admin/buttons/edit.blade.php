@if(\Route::has($currentRoute.".edit")??false)
    <a href="{{ route($currentRoute.".edit", [$listItem->id]) }}" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
@endif