@php
    $id = $id??str_random(5);
@endphp
<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <select class="form-control select2"  {{ $data??"" }} id="{{ $id }}" {{ $multiple??"" }}>
        <option></option>
        @foreach($options as $option)
            @if($option->id==($content->id??""))
                @continue
            @endif
            <option value="{{ $option->id }}" {{ ($content->$name??false)==$option->id?"selected=selected":"" }}>{{$option->name}}</option>
        @endforeach
    </select>
</div>