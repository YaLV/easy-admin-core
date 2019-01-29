@php
    $oldValues = \App\Plugins\Attributes\Model\AttributeValue::whereIn('id', old('attributeValue')??[]);
    $values = ($oldValues->count()?$oldValues->get():($content->values??[]));
@endphp

<table class="table table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th>slug</th>
        <th><a href="#" class="addLine btn btn-success btn-xs" data-toggle="modal"
               data-target="#modalWin{{$modalId}}"><i class="fas fa-plus"></i></a></th>
    </tr>
    </thead>
    <tbody class="attributeValues">
    @foreach($values as $attributeValue)
        @include("Attributes::avalue")
    @endforeach
    </tbody>
</table>

@include("Attributes::modal")


@push('scripts')
    <script>
        jQuery(document).ready(function() {
            jQuery('.saveAttributeValue').click(function (e) {
                e.preventDefault();
                jQuery.post("{{route('attributes.value.store')}}", jQuery('#post{{$modalId}}').serialize(), function (response) {
                    if (response.status) {
                        atv = $("[data-vid=" + response.attributeValue + "]");
                        if (atv.length > 0) {
                            atv.replaceWith(response.result);
                        } else {
                            $('.attributeValues').append(response.result);
                        }
                        $('#modalWin{{$modalId??false}}').modal('hide');
                        bindModalButtons();
                    }
                });
                return false;
            });

            jQuery('.addLine').click(function () {
                $('#modalWin{{$modalId??false}} input').val('');
            });
            bindModalButtons();
        });

        function bindModalButtons() {
            jQuery('.loadAttributeValue').unbind().click(function (e) {
                e.preventDefault();
                jQuery.post("{{ route('attributes.value.load') }}", "id=" + $(this).data('id'), function (result) {
                    console.log(result);
                    if (result.status) {
                        data = result.result;
                        form = $('#post{{$modalId??false}}');
                        for (x in data) {
                            for (y in data[x]) {
                                console.log('[data-fieldname=' + x + '][data-language='+y+']');
                                form.find('[data-fieldname=' + x + '][data-language='+y+']').val(data[x][y]);
                            }
                        }
                        form.find('[name=id]').val(result.resultId);
                        $('#modalWin{{$modalId??false}}').modal('show');
                    }
                });
            });

            jQuery('.removeLine').unbind().click(function (e) {
                e.preventDefault();
                jQuery(this).parents('.attributeValue').remove();
                return false;
            })
        }
    </script>
@endpush
