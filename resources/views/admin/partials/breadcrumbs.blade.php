<div class="row">
    <div class="col-md-10">
        <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach($breadcrumbs??[] as $crumb)
                        @if(is_null($crumb))
                            @continue
                        @endif
                        @if($loop->last)
                            <li class="breadcrumb-item active" aria-current="page">{!! $crumb->displayName !!}</li>
                            @break
                        @endif
                        @if(is_object($crumb))
                            @if($crumb->action??false && !preg_match("/[{}]/",$crumb->slug))
                                <li class="breadcrumb-item"><a href="{{ route($crumb->routeName) }}"
                                                               class="breadcrumb-link">{!! $crumb->displayName !!}</a></li>
                            @else
                                <li class="breadcrumb-item" aria-current="page">{!! $crumb->displayName !!}</li>
                            @endif
                        @endif
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
    <div class="col-md-2 text-right">
        {!! $operations??"" !!}
    </div>
</div>