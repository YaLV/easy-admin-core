@php
    $id = $id??str_random(5);
    $selectedItems = old($name)??$content->formatSelected($name);
@endphp
<div class="row">
    <div class="col-md-2"><h5 style="color:#71748d;font-weight:normal">{{ $label }}</h5></div>
    <div class="col-md-8">
        <div class="form-group" style="margin-bottom:20px;">
            <select class="multiselect {{ $class??"" }}" style="display:none;" {{ $data??"" }} id="{{ $id }}"
                    multiple="multiple" name="{{$name}}[]" {{ $data??"" }} tabindex="-98">
                @foreach($options as $option)
                    <option value="{{ ($option->id??$option['id']) }}"
                            {{ in_array($option->id??$option['id'], (array)$selectedItems)?"selected=selected":"" }}>
                        {{($option->name??$option['name']??"")}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>