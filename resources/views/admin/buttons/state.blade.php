@if(\Route::has($currentRoute.".state")??false && $hasSoftDeletes)
    <a href="{{ route($currentRoute.".state", [$listItem->id]) }}" class="btn btn-xs btn-info stateButton"><i class="fas fa-{{ $listItem->trashed()??false?"eye-slash":"eye" }}"></i></a>
@endif