@php
    $multiple = count($options)>1;
@endphp

<div class="form-group">
    <label>{{ $label }}</label>
    @foreach($options as $option)
        @php
            $tid = $id??str_random(5);
            $checkData = [];
        @endphp

        @if($option['data']??[])
            @foreach($option['data'] as $dataAttr => $dataValue)
                @php
                    $checkData[] = "data-$dataAttr=$dataValue";
                @endphp
            @endforeach
        @endif

        <label class="custom-control custom-checkbox">
            <input id="{{$tid}}" type="checkbox"
                   {{ ($content->$name??false)==$option['value']?"checked=checked":"" }} name="{{$name}}{{$multiple?"[]":""}}"
                   {{ implode(" data-", $checkData??[])??$data??"" }} class="custom-control-input {{$class??""}}"
                   value="{{ $option['value'] }}" />
            <span class="custom-control-label">{{ $option['label'] }}</span>
        </label>
    @endforeach
</div>