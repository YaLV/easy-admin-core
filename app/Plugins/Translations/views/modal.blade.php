@section("modal_title_{$modalId['Translations']}")
    Translation
@endsection

@section("modal_body_{$modalId['Translations']}")
    @foreach(languages() as $languages)
        <div class="row">
            <div class="col-md-4" >{{ $languages->name }}</div>
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" class="form-control" data-transFor="{{ $languages->code }}" name="translation[{{ $languages->code }}]" />
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section("modal_footer_{$modalId['Translations']}")
    <button type="button" class="btn btn-success btn-xs saveTranslation">Save</button>
@endsection
