<tr class="variation" data-vid="{{$variation->id}}">
    <td>{{ $variation->for_supplier }}</td>
    <td>{{ $variation->amount }}{{ ($content->unit??false)?$content->unit->unit:"" }}</td>
    <td>{{ $variation->display_name }}</td>
    <td>
        <div class="btn-group">
            <a href="#" class="btn btn-warning btn-xs loadVariation" data-id="{{$variation->id}}"><i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-danger btn-xs removeLine"><i class="fas fa-trash-alt"></i></a>
        </div>
    </td>
</tr>