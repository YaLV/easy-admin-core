<div class="preview_image_container" data-mainImage="{{$image->main}}" data-id="{{$image->id}}">
    <div class="preview_image">
        <input type="hidden" name="image_url[]" class="imUrl" value="{{ $image->filePath }}" />
        <input type="hidden" name="image_id[]" class="imId" value="{{ $image->id }}" />
        <input type="hidden" name="image_main[]" class="imMain" value="{{ $image->main }}" />
        @if(($language??false))
            <input type="hidden" name="image_lang[]" class="imLang" value="{{ $language }}" />
        @endif
        <img src="/{{ implode("/", array_merge([config("app.uploadFile.{$image->owner}")??$owner], [($path??current(config("app.imageSize.{$image->owner}")??[]))?:'original'], [$image->filePath])) }}" />
    </div>
</div>