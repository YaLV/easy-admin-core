<table>
    <tr>
        <th colspan="{{ $colcount }}">{{ $marketday }}</th>
    </tr>
    <tr>
        <th>{{  __('translations.supplier') }}</th>
        <th colspan="{{ $colcount-1 }}">{{ $farmer }}</th>
    </tr>
    <tr>
        <th>{{  __('translations.email') }}</th>
        <th colspan="{{ $colcount-1 }}">{{ $email }}</th>
    </tr>
    <tr>
        <th>{{  __('translations.comment') }}</th>
        <th colspan="{{ $colcount-1 }}">{{ $comment??"" }}</th>
    </tr>

    <tr>
        @foreach($headers as $headerLine)
            <th>{{$headerLine['name']}}</th>
        @endforeach
    </tr>
    @foreach($lines as $line)
        @include("Orders::pdf.line")
    @endforeach
</table>