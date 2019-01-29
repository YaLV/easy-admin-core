@php
    $selectedValues = $selectedAttributes??$attribute->attributeValuesList($content->id)??[];
@endphp
<tr class="attribute" data-vid="{{$attribute->id}}">
    <td>
        <input type="hidden" name="attribute[]" value="{{$attribute->id}}" />
        {{ __('attributes.name.'.$attribute->id) }}
    </td>
    <td>
        @foreach($selectedValues as $selVal)
            <input type="hidden" name="attributeValues[]" value="{{$selVal->id}}" />
            {{ __('attributevalues.name.'.$selVal->id).($loop->last?"":",") }}
        @endforeach
    </td>
    <td>
        <div class="btn-group">
            <a href="#" class="btn btn-warning btn-xs loadAttribute" data-id="{{$attribute->id}}"><i
                        class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-danger btn-xs removeLine"><i class="fas fa-trash-alt"></i></a>
        </div>
    </td>
</tr>
