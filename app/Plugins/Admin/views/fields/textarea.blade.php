@php
    $id = str_random(5);
    $lang = "";
    if(($language??false)) {
        $lang="[$language]";
        if($meta??false) {
            $savedContent = $content->meta[$name]??"";
        } else {
            $savedContent = is_array($content->$name) ? $content->$name : $content->{str_plural($name)};
        }
        $oldValue = old($name)[$language]??$savedContent[$language]??"";
    } else {
        $oldValue = old($name)??$content->$name??"";
    }
@endphp
<div class="row">
    <div class="col-md-2">
        <label for="{{$id}}">{{ $label }}</label>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <textarea class="form-control {{$class??""}}" id="{{$id}}" rows="3"
                      {{ $data??"" }} name="{{$name}}{{$lang}}">{{$oldValue}}</textarea>
        </div>
    </div>
</div>

