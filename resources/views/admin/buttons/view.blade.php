@if(\Route::has($currentRoute.".view")??false)

    @if((in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($listItem)) && !$listItem->trashed()) || !in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($listItem)))
        <a href="{{ route($currentRoute.".view", [$listItem->id]) }}" class="btn btn-xs btn-info viewButton"><i class="fas fa-folder-open"></i></a>
    @endif
@endif