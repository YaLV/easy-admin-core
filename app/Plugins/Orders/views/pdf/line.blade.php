<tr>
    @foreach($headers as $headerLine)
        <td {{ $headerLine['key']=='' }}>{{$line[$headerLine['key']]}}</td>
    @endforeach
</tr>