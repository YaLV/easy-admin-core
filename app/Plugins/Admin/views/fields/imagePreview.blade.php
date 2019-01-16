<div class="preview_image_container" data-mainImage="{{$image->main}}" data-id="{{$image->id}}">
    <div class="preview_image">
        <input type="hidden" name="image_url[]" class="imUrl" value="{{ $image->filePath }}" />
        <input type="hidden" name="image_id[]" class="imId" value="{{ $image->id }}" />
        <input type="hidden" name="image_main[]" class="imMain" value="{{ $image->main }}" />
        <img src="{{$image->filePath}}" />
    </div>
</div>