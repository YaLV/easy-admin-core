<div class="form-group">
    @php
        $id = $id??str_random(5);
        if(($language?:false)) {
            $lang="[$language]";
            $savedContent = $content->{str_plural($name)};
            $oldValue = old($name.$lang)??$savedContent[$language]??"";
        } else {
            $language="";
            $oldValue = old($name)??$content->$name??"";
        }
    @endphp

    <label for="{{$id}}" class="col-form-label">{{ $label }}</label>
    <input id="{{$id}}" type="{{ $type }}" name="{{ $name }}{{ $lang??"" }}" value="{{ $oldValue }}"
           class="form-control {{ $class??"" }} {{ ($errors->has($name)?:$errors->has("$name.$language")?:false)?"is-invalid":"" }}" {{ $data??"" }} {{ ($depends??false)?"data-depends=$depends":"" }} />
    @if($errors->has($name) || $errors->has("$name.$language"))
        <div class="invalid-feedback">
            {{ $errors->first($name)?:$errors->first("$name.$language") }}
        </div>
    @endif
</div>

