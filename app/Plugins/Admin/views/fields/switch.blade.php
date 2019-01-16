<div class="form-group row">
    <label class="col-12 col-sm-3 col-form-label text-sm-right">{{ $label }}</label>
    <div class="col-12 col-sm-8 col-lg-6 pt-1">
        @php
            $id = $id??str_random(5);
        @endphp
        <div class="switch-button switch-button-success">
            <input type="checkbox" {{ ($content->$name??false)?"checked=checked":"" }} name="{{ $name }}"
                   id="{{$id}}" />
            <span>
                <label for="{{$id}}"></label>
            </span>
        </div>
    </div>
</div>