@section("modal_title_{$modalId['menu']}")
    Add Menu Item
@endsection

@foreach((new \App\Plugins\Admin\AdminController)->getApplicableMenuCategories()??[] as $menuCategory)
    @push('categories')
        <option value="{{ $menuCategory['header']['slug'] }}">{{ $menuCategory['header']['name'] }}</option>
    @endpush
    @foreach($menuCategory['items']??[] as $item)
        @push('selectables')
            <option data-category="{{ $menuCategory['header']['slug'] }}" value="{{$item}}">{{ __("{$menuCategory['header']['slug']}.name.$item") }}</option>
        @endpush
    @endforeach
@endforeach

@section("modal_body_{$modalId['menu']}")
        <div class="row">
            <div class="col-md-4">Select Category:</div>
            <div class="col-md-8">
                <div class="form-group">
                    <select name="owner" class="showChildren selectpicker">
                        <option></option>
                        @stack('categories')
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">Select Menu Item:</div>
            <div class="col-md-8">
                <div class="form-group">
                    <select name="owner_id" class="owner_id selectpicker" data-live-search="true">
                        <option></option>
                        @stack('selectables')
                    </select>
                </div>
            </div>
        </div>
@endsection

@section("modal_footer_{$modalId['menu']}")
    <button type="button" class="btn btn-success btn-xs addMenuItem">Add Menu Item</button>
    <button type="button" class="btn btn-warning btn-xs addMenuItem andClose">Add Menu Item And Close</button>
@endsection
