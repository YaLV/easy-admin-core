@php

    $language = $language??null;
    $id = $id??str_random(5);
    if(($language?:false)) {
        $lang="[$language]";
        if($meta??false) {
            $savedContent = $content->meta[$name]??"";
        } else {
            $savedContent = is_array($content->$name) ? $content->$name : $content->{str_plural($name)};
        }
        $oldValue = old($name)[$language]??$savedContent[$language]??"";
    } else {
        $language="";
        $oldValue = old($name)??$content->$name??"";
    }
@endphp

<div class="row">
    <div class="col-md-2">
        <label for="{{$id}}" class="col-form-label">{{ $label }}</label>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <input id="{{$id}}"
                   type="{{ $type }}"
                   name="{{ $name }}{{ $lang??"" }}"
                   value="{{ $oldValue }}"
                   {{ in_array("slugify", explode(" ",($class??[])))||$name=='slug'?"data-language=$language":"" }}
                   class="form-control{{$name=="slug"?" slug":""}} {{ $class??"" }}{{ ($errors->has($name)?:$errors->has("$name.$language")?:false)?" is-invalid":"" }}{{ ($readonly??false)?" disabled":"" }}"
                    {{ ($readonly??false)?"tabindex=-1":"" }}
                    {{ $readonly??"" }}
                    {{ $data??"" }}
                    {{ ($depends??false)?"data-depends=$depends":"" }} />
            @if($errors->has($name) || $errors->has("$name.$language"))
                <div class="invalid-feedback">
                    {{ $errors->first($name)?:$errors->first("$name.$language") }}
                </div>
            @endif
        </div>
    </div>
</div>
