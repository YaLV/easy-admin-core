@if(\Route::has($currentRoute.".view")??false)
    <a href="{{ route($currentRoute.".view", [$listItem->id]) }}" class="btn btn-xs btn-info viewButton"><i class="fas fa-folder-open"></i></a>
@endif