@section("modal_title_{$modalId['attribute']}")
    Attribute Value
@endsection

@section("modal_body_{$modalId['attribute']}")
    @foreach(languages() as $language)
        <div class="row">
            <div class="col-md-4">Attribute Name ({{$language->name}}):</div>
            <div class="col-md-8">
                <div class="form-group">
                    <input type="hidden" name="id" value="" />
                    <input type="text" data-fieldname="name" data-language="{{$language->code}}" name="name[{{$language->code}}]" class="form-control" />
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section("modal_footer_{$modalId['attribute']}")
    <button type="button" class="btn btn-success btn-xs saveAttributeValue">Save Attribute Value</button>
@endsection
