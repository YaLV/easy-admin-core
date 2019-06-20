@section("modal_title_{$modalId['categories']}")
    Product Attributes
@endsection

@section("modal_body_{$modalId['categories']}")
    <div class="row">
        <div class="col-md-4">Attribute:</div>
        {{--<div class="col-md-8">
            <select name="attributeSel" class="selectpicker">
                <option></option>
                @foreach(\App\Plugins\Attributes\Model\Attribute::all() as $attribute)
                    <option value="{{$attribute->id}}">{{__('attributes.name.'.$attribute->id)}}</option>
                @endforeach
            </select>
        </div>--}}
    </div>
    <div class="row">
        <div class="col-md-4">Attribute Values:</div>
        <div class="col-md-8">
            {{--<select name="attributeValuesSel[]" id="attributeValues" multiple class="multiselect" data-product="{{$content->id}}">
            </select>--}}
        </div>
    </div>
@endsection

@section("modal_footer_{$modalId['categories']}")
    <button type="button" class="btn btn-success btn-xs saveAttribute">Save Category</button>
@endsection
