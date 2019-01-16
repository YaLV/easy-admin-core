@php
    $id = str_random(5);
    $lang = "";
    if(($language??false)) {
        $lang="[$language]";
        $savedContent = $content->{str_plural($name)};
        $oldValue = old($name.$lang)??$savedContent[$language]??"";
    } else {
        $oldValue = old($name)??$content->$name??"";
    }
@endphp
<div class="form-group">
    <label for="{{$id}}">{{ $label }}</label>
    <textarea class="form-control {{$class??""}}" id="{{$id}}" rows="3"
              {{ $data??"" }} name="{{$name}}{{$lang}}">{{$oldValue}}</textarea>
</div>