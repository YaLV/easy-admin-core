@php
    $id = $id??str_random(5);
@endphp
<div class="row">
    <div class="col-md-2">
        <label for="{{$id}}" class="col-form-label">{{ $label }}</label>
        <br />
        <a href="javascript:void()" class="btn btn-xs btn-info" onclick="setDefault('{{$id}}')">Set Default Color</a>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <input type="hidden" name="{{$name}}" value="{{ $content->$name??$default }}" />
            <div class="colorSelector" id="{{$id}}" data-defaultcolor="{{ $content->$name??$default }}"></div>
            @if($errors->has($name))
                <div class="invalid-feedback">
                    {{ $errors->first($name) }}
                </div>
            @endif
        </div>
    </div>
</div>