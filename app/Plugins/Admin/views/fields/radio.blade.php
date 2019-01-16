<div class="form-group">
    <label>{{ $label }}</label>
    @foreach($options as $option)
        @php
            $id = $id??str_random(5);
        $checkData = [];
        @endphp
        @if($option['data']??[])
            @foreach($option['data'] as $dataAttr => $dataValue)
                @php
                    $checkData[] = "data-$dataAttr=$dataValue";
                @endphp
            @endforeach
        @endif

        <label class="custom-control custom-radio">
            <input type="radio" name="{{ $name }}"
                   {{ implode(" data-", $checkData??[])??$data??"" }} {{ ($content->$name??false)==$option['value']?"checked=checked":"" }} class="custom-control-input {{ $class??"" }}" value="{{ $option['value'] }}" />
            <span class="custom-control-label">{{ $option['label'] }}</span>
        </label>
    @endforeach
</div>



