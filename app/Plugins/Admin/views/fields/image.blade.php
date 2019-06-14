@php
    $id = $id??str_random(5);
    /** @var \App\Plugins\Admin\Model\File $oldImages */
    $oldImages = \App\Plugins\Admin\Model\File::whereIn('id', old('image_id')??[]);
    $images = $oldImages->count()?$oldImages->get():null;


@endphp

<div class="row">
    <div class="col-md-2">
        <label for="{{$id}}" class="col-form-label">{{ $label }}</label>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <input id="{{$id}}" type="file" name="{{ $name }}" multiple
                   class="form-control defaultUpload {{ $class??"" }} {{ $errors->has($name)?"is-invalid":"" }}" {{ $data??"" }} {{ ($depends??false)?"data-depends=$depends":"" }}  {{ ($language??false)?"data-lang=$language":"" }} />
            @if($errors->has($name))
                <div class="invalid-feedback">
                    {{$errors->first($name)}}
                </div>
            @endif
        </div>
    </div>
</div>
@if($preview??false)
    <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 preview" data-file="{{$id}}" data-path='{{ $name }}' {{ ($language??false)?"data-lang=$language":"" }}>
        @php
            if($language??false) {
                $content->language = $language;
            }
        @endphp
        @foreach($images??$content->$name??[] as $image)
            @include('Admin::fields.imagePreview')
        @endforeach
    </div>
</div>
@endif