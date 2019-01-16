@if(\Route::has($currentRoute.".destroy")??false)
    <a href="{{ route($currentRoute.".destroy", [$listItem->id]) }}" class="btn btn-xs btn-danger destroyButton" data-message="Do You really want to delete this {{$destroyName}} {{$listItem->$idField}}"><i class="fas fa-trash-alt"></i></a>
@endif