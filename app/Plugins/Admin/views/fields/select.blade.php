@php
    $id = $id??str_random(5);
    $language = null;
    if(is_object($content) && property_exists($content, 'language') && ($language??false)) {
        $content->language = $language = $language??"";
    }
@endphp

<div class="row">
    <div class="col-md-2">
        <h5 style="color:#71748d;font-weight:normal">{{ $label }}</h5>
    </div>
    <div class="col-md-9">
        <div class="form-group" style="margin-bottom:20px;">
            <select class="selectpicker {{ $class??"" }}{{ ($errors->has($name)?:$errors->has("$name.$language")?:false)?" is-invalid":"" }}"
                    {{ $data??"" }} id="{{ $id }}"
                    {{ $multiple??"" }} name="{{$name}}{{($multiple??false)?"[]":($language?"[$language]":"") }}" {{ $data??"" }} tabindex="-98">
                <option></option>
                @foreach($options as $option)
                    @if($option->id==($content->id??"") && class_basename($content) == class_basename($option))
                        @continue
                    @endif
                    @if($multiple??false)
                        <option value="{{ $option->id }}" {{ in_array($option->id, (old($name)??$content->$name->pluck('id')->toArray()??[]))?"selected=selected":"" }}>{{$option->name}}</option>
                    @else
                        <option value="{{ $option->id }}" {{ (old($name)??$content->$name??false)==$option->id?"selected=selected":"" }}>{{$option->name}}</option>
                    @endif
                @endforeach
            </select>
            @if($errors->has($name) || $errors->has("$name.$language"))
                <div class="invalid-feedback">
                    {{ $errors->first($name)?:$errors->first("$name.$language") }}
                </div>
            @endif
        </div>
    </div>
</div>

