@if(request()->has('endorsment'))
    {{ dd(request()->all()) }}
@endif

@php
$fields = [
    (object)['tag'=>"endorsment", 'name'=> 'ENDORSMENT', 'required'=> true],
    (object)['tag'=>"survival", 'name'=> 'SURVIVAL......', 'required'=> true],
    (object)['tag'=>"firefighting", 'name'=> 'FIREFIGHT', 'required'=> true],
    (object)['tag'=>"basic", 'name'=> 'BASIC TRAINING', 'required'=> true ,'placeholder' => 'dd/mm/yyyy'],
];
@endphp

<form method="get">
    @foreach($fields as $fieldset)
        {{$fieldset->name}}
        <select name="{{$fieldset->tag}}[country]">
            <option></option>
        </select>
        <input type="text" name="{{$fieldset->tag}}[from]">
        <input type="text" name="{{$fieldset->tag}}[issued]">
        <input type="text" name="{{$fieldset->tag}}[expires]">
        <br />
    @endforeach

    <input type="submit">
</form>