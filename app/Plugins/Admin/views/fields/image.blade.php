
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            @php
                $id = $id??str_random(5);
            @endphp
            <label for="{{$id}}" class="col-form-label">{{ $label }}</label>
            <input id="{{$id}}" type="file" name="{{ $name }}" multiple
                   class="form-control {{ $class??"" }} {{ $errors->has($name)?"is-invalid":"" }}" {{ $data??"" }} {{ ($depends??false)?"data-depends=$depends":"" }} />
            @if($errors->has($name))
                <div class="invalid-feedback">
                    {{$errors->first($name)}}
                </div>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 preview" data-file="{{$id}}" data-path='{{ $name }}'>
        @if($content->$name && is_object($content->$name))
            @foreach($content->$name??$images as $image)
                @include('Admin::fields.imagePreview')
            @endforeach
        @endif
    </div>
</div>
