@php
    $VAT = \App\Plugins\Vat\Model\Vat::all();
    foreach($VAT as $vatID => $vat) {
        $vats[$vatID] = $vat->amount;
    }
    $oldVariations = \App\Plugins\Products\Model\ProductVariation::whereIn('id', old('variation')??[]);
    $variations = ($oldVariations->count()?$oldVariations->get():($content->variations??[]));
@endphp
<table class="table table-hover">
    <thead>
    <tr>
        <th>Info for supplier</th>
        <th>Amount</th>
        <th>Display part</th>
        <th><a href="#" class="addLine btn btn-success btn-xs" data-toggle="modal"
               data-target="#modalWin{{$modalId['variations']}}"><i class="fas fa-plus"></i></a></th>
    </tr>
    </thead>
    <tbody class="variations">
        @foreach($variations as $variation)
            @include("Products::variation")
        @endforeach
    </tbody>
</table>
@include("Products::modal")

@push('scripts')
    <script>
        jQuery(document).ready(function () {
            jQuery("#post{{$modalId['variations']}}").submit(function(){return false;})
            bindModalButtons();

            jQuery('.calcPrice').click(function (e) {
                e.preventDefault();
                jQuery.post("{{route('products.calc')}}", jQuery('#post{{$modalId['variations']}}').serialize(), function (response) {
                    if (response.status) {
                        jQuery('.calcPriceValue').val(response.result);
                    }
                });
                return false;
            });

            jQuery('.set_unit_id').on("changed.bs.select", function(e, index, newItem, oldItem){
                id = $(this)[0].options[index].value;
                name = $(this)[0].options[index].innerHTML;

                jQuery('.unit_id_receive').val(id);
                jQuery('.unit_name').html(name);
            });

            jQuery('.makeDisplay').click(function (e) {
                e.preventDefault();
                jQuery.post("{{route('products.makedisplay')}}", jQuery('#post{{$modalId['variations']}}').serialize(), function (response) {
                    if (response.status) {
                        jQuery('.displayValue').val(response.result);
                    }
                });
                return false;
            });

            jQuery('.saveVariation').click(function (e) {
                e.preventDefault();
                jQuery.post("{{route('products.variations.store')}}", jQuery('#post{{$modalId['variations']}}').serialize(), function (response) {
                    if (response.status) {
                        if ($("[data-vid=" + response.variation + "]").length > 0) {
                            $("[data-vid=" + response.variation + "]").replaceWith(response.result);
                        } else {
                            $('.variations').append(response.result);
                        }
                        $('#modalWin{{$modalId['variations']??false}}').modal('hide');
                        bindModalButtons();
                    }
                });
                return false;
            });

            jQuery('.addLine').click(function () {
                setDefaultDropdowns();
                $($(this).data('target')+' input[type=text]').val('');
            });
            setDefaultDropdowns();
        });

        function setDefaultDropdowns() {
            jQuery('[data-toggle][data-label]').each(function () {
                $(this).html($(this).data('label'));
            });
        }

        function bindModalButtons() {
            jQuery('.loadVariation').unbind().click(function (e) {
                e.preventDefault();
                jQuery.post("{{ route('products.variations.load') }}", "id=" + $(this).data('id'), function (result) {
                    if (result.status) {
                        data = result.result;
                        form = $('#post{{$modalId['variations']??false}}');
                        for (x in data) {
                            if (x === 'vat_id') {
                                form.find('[name=vat_id]').val(data[x]).selectpicker("refresh");
                            } else if (x === 'unit_id') {
                                el = form.find('[name=unit_id]');
                                el.val(data[x]);
                                el.next().html(jQuery('.dropdown-menu [data-value=' + data[x] + ']').text());
                            } else {
                                form.find('[name=' + x + ']').val(data[x]);
                            }
                        }
                        $('#modalWin{{$modalId['variations']??false}}').modal('show');
                        form.find('.calcPrice').click();
                    }
                });
            });

            jQuery('.removeLine').unbind().click(function (e) {
                e.preventDefault();
                jQuery(this).parents('.variation,.attribute').remove();
                return false;
            })
        }
    </script>
@endpush