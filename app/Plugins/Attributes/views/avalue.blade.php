<tr class="attributeValue" data-vid="{{$attributeValue->id}}">
    <td>
        <input type="hidden" name="attributeValue[]" value="{{$attributeValue->id}}" />
        {{ __("attributevalues.name.{$attributeValue->id}") }}
    </td>
    <td>
        {{ __("attributevalues.slug.{$attributeValue->id}") }}
    </td>
    <td>
        <div class="btn-group">
            <a href="#" class="btn btn-warning btn-xs loadAttributeValue" data-id="{{$attributeValue->id}}"><i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-danger btn-xs removeLine"><i class="fas fa-trash-alt"></i></a>
        </div>
    </td>
</tr>

