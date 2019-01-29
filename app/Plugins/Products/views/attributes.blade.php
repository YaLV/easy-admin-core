@php
    $oldAttributes = \App\Plugins\Attributes\Model\Attribute::whereIn('id', old('attribute')??[]);

    $attributes = $oldAttributes->count()?$oldAttributes->get():$content->attributes;
@endphp

<table class="table table-hover">
    <thead>
    <tr>
        <th>Attribute</th>
        <th>Values</th>
        <th><a href="#" class="addLine clearMultiSelect btn btn-success btn-xs" data-toggle="modal"
               data-target="#modalWin{{$modalId['attributes']}}"><i class="fas fa-plus"></i></a></th>
    </tr>
    </thead>
    <tbody class="attributes">
    @foreach($attributes??[] as $attribute)
        @include("Products::attribute")
    @endforeach
    </tbody>
</table>


@include("Products::attributeModal")

@push('scripts')
    <script>
        jQuery(document).ready(function () {
            jQuery('.clearMultiSelect').click(function () {
                av = $('#attributeValues');
                av.find('option').remove()
                av.multiSelect("refresh");
                an = $('[name=attributeSel]');
                an.val('').selectpicker("refresh");
            });
            bindAttributeButtons();
            jQuery("[name=attributeSel]").on("changed.bs.select", function (e, clickedIndex, newValue, oldValue) {
                loadAttributes(this.value);
            });
            jQuery("#post{{$modalId['attributes']}}").submit(function () {
                return false;
            })

            jQuery(".saveAttribute").click(function () {
                form = $('#post{{$modalId['attributes']??false}}');
                jQuery.post('{{route('products.attributes.format')}}', form.serialize(), function (result) {
                    if (result.status) {
                        if (result.remove) {
                            jQuery("[data-vid=" + result.attributeId + "]").remove();
                        }
                        eai = $('[data-vid=' + result.attributeId + ']');
                        if (eai.length > 0) {
                            eai.replaceWith(result.data);
                        } else {
                            jQuery('.attributes').append(result.data);
                        }
                        jQuery('#modalWin{{$modalId['attributes']??false}}').modal('hide');
                        bindAttributeButtons();
                    }
                });
            });
        });

        function getUsedAttributeValues() {
            let usedAttributeValues = new Array;
            jQuery('[name^=attributeValues]').map(function (idx, elem) {
                usedAttributeValues.push(parseInt($(elem).val()));
            });
            return usedAttributeValues;
        }

        function bindAttributeButtons() {
            jQuery('.loadAttribute').unbind().click(function () {
                eb = jQuery(this);
                loadAttributes(eb.data('id'));
            });
        }

        function loadAttributes(attribute) {
            av = $('#attributeValues');
            as = jQuery("[name=attributeSel]");
            usedAttributeValues = getUsedAttributeValues();
            jQuery.post("{{route('products.attributes.load')}}", "product=" + av.data('product') + "&attribute=" + attribute, function (result) {
                if (result.status) {
                    av.find('option').remove();
                    for (x in result.options) {
                        if (jQuery('[data-vid='+result.options.attribute+']').length>0) {
                            if(!usedAttributeValues.includes(result.options[x].id)) {
                                result.options[x].selected = false;
                            }
                        }
                        av.append(new Option(result.options[x].name, result.options[x].id, false, result.options[x].selected));
                    }
                    as.val(attribute).selectpicker("refresh");
                    av.multiSelect('refresh');
                    jQuery("#modalWin{{$modalId['attributes']}}").modal('show');
                }
            });
        }
    </script>
@endpush