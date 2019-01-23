<tr class="variation" data-vid="{{$variation->id}}">
    <td class="addCash">
        <input type="hidden" name="variation[]" value="{{$variation->id}}" />
        {{ $variation->cost }}
    </td>
    <td class="addPercent">{{ $variation->mark_up }}</td>
    <td class="addPercent">{{ $variation->vat->amount }}</td>
    <td class="addCash">{{ $variation->price }}</td>
    <td>{{ $variation->for_supplier }}</td>
    <td>{{ $variation->display_name }}</td>
    <td>
        <div class="btn-group">
            <a href="#" class="btn btn-warning btn-xs loadVariation" data-id="{{$variation->id}}"><i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-danger btn-xs removeLine"><i class="fas fa-trash-alt"></i></a>
        </div>
    </td>
</tr>