@section("modal_title_{$modalId['variations']}")
    Product Variation
@endsection

@section("modal_body_{$modalId['variations']}")
        {{--<div class="row">
            <div class="col-md-4">Cost:</div>
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="cost" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">Mark Up:</div>
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="mark_up" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">Vat:</div>
            <div class="col-md-8">
                <div class="form-group">
                    <select name="vat_id" class="selectpicker">
                        <option></option>
                        @foreach($VAT as $vat)
                            <option value="{{ $vat->id }}">{{$vat->name}} ({{$vat->amount}}%)</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">Price:</div>
            <div class="col-md-8">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control calcPriceValue" readonly="readonly" />
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary btn-xs calcPrice"><i class="fas fa-calculator"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
        <div class="row">
            <div class="col-md-4">Amount In Package:</div>
            <div class="col-md-8">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="hidden" name="id" value="" />
                        <input type="text" class="form-control" name="amount" />
                        <div class="input-group-append be-addon">
                            <input type="hidden" class="unit_id_receive" name="unit_id" value="" />
                            <span class="input-group-text unit_name"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">SupplierInfo:</div>
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="for_supplier" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">Display Name:</div>
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="display_name" class="form-control" />
                </div>
            </div>
        </div>
{{--
        <div class="row">
            <div class="col-md-4">Display:</div>
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <input type="text" class="form-control displayValue" name="display_name" />
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary btn-xs makeDisplay"><i class="fas fa-pencil-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>
--}}
@endsection

@section("modal_footer_{$modalId['variations']}")
    <button type="button" class="btn btn-success btn-xs saveVariation">Add Variation</button>
@endsection
