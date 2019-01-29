@section("modal_title_{$modalId['variations']}")
    Product Variation
@endsection

@section("modal_body_{$modalId['variations']}")
        <div class="row">
            <div class="col-md-4">Cost:</div>
            <div class="col-md-8">
                <div class="form-group">
                    <input type="hidden" name="id" value="" />
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
        </div>
        <div class="row">
            <div class="col-md-4">Amount In Package:</div>
            <div class="col-md-8">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="amount" />
                        <div class="input-group-append be-addon">
                            <input type="hidden" name="unit_id" value="" />
                            <button type="button" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle" aria-expanded="false" data-label="Select Unit"></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(1160px, 41px, 0px); top: 0px; left: 0px; will-change: transform;">
                                @foreach(\App\Plugins\Units\Model\Unit::all() as $unit)
                                    <a href='#' class="dropdown-item selectUnit" class="selectUnit" data-value="{{ $unit->id }}">{{ $unit->name }}</a>
                                @endforeach
                            </div>
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
@endsection

@section("modal_footer_{$modalId['variations']}")
    <button type="button" class="btn btn-success btn-xs saveVariation">Add Variation</button>
@endsection
