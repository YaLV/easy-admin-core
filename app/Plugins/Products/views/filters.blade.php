@foreach($content->filters??[] as $filter)
    Filter {{$loop->index}}<br />
@endforeach