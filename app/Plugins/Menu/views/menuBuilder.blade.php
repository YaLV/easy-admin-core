<div class="row">
    <div class="col-md-2">Menu Items</div>
    <div class="col-md-8 created_buttons">
        <input type="hidden" name="menuContent" value="" id="menuContent" />
        <ol id="created_buttons_list">
            @foreach($content->menuItems()->whereNull('frontend_menu_item_id')->get() as $menuItem)
                @include("Menu::menuItem")
            @endforeach
        </ol>
    </div>
    <div class="col-md-2">
        <a href="#" class="addItem btn btn-success btn-xs" data-toggle="modal"
           data-target="#modalWin{{$modalId['menu']}}"><i class="fas fa-plus"></i></a>
    </div>
</div>

@include("Menu::modal")


@push('scripts')
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    <script src="{{asset('js/jquery.mjs.nestedSortable.js')}}"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('ol#created_buttons_list').nestedSortable({
                forcePlaceholderSize: true,
                handle: 'div',
                helper: 'clone',
                items: 'li',
                maxLevels: 3,
                opacity: .6,
                placeholder: 'placeholder',
                revert: 250,
                tabSize: 25,
                tolerance: 'pointer',
                toleranceElement: '> div',
                relocate: function () {
                    content = $(this).nestedSortable('toHierarchy', {startDepthCount: 0});
                    $('#menuContent').val(JSON.stringify(content));
                }
            });

            $('form').submit(function () {
                content = jQuery('ol#created_buttons_list').nestedSortable('toHierarchy', {startDepthCount: 0});
                $('#menuContent').val(JSON.stringify(content));
            });

            $('.div_menu_button>div.action').click(function () {
                ol = $(this).parent().next();
                ol.toggle('blind', 200, function () {
                    if (ol.is(":hidden")) {
                        ol.prev().find('.action>i').removeClass('fa-minus').addClass('fa-plus');
                    } else {
                        ol.prev().find('.action>i').removeClass('fa-plus').addClass('fa-minus');
                    }
                });
            });
            $('.addItem').click(function () {
                form = jQuery('#post{{$modalId['menu']}}');
                form[0].reset();
                form.find('select.owner_id option').hide();
                form.find('select').selectpicker("refresh");

            });

            $('.showChildren').on('changed.bs.select', function (e, clickedIndex, newValue, oldValue) {
                form = jQuery('#post{{$modalId['menu']}}');
                form.find('select.owner_id option').prop('selected', false).hide();
                if (this.value) {
                    $('select.owner_id option[data-category=' + this.value + ']').show();
                }
                form.find('select').selectpicker("refresh");
            });

            $('.addMenuItem').click(function () {
                el = $(this);
                form = jQuery('#post{{$modalId['menu']}}');
                $.post("{{  route('menus.store.item', [request()->route('id')]) }}", form.serialize(), function(response) {
                   if(response.status) {
                       $('#created_buttons_list').append(response.content);
                       if(el.hasClass('andClose')) {
                           $("#modalWin{{$modalId['menu']}}").modal('hide');
                       }
                       bindDestroy();
                   }
                });
            });

            bindDestroy();
        });
        function bindDestroy() {
            $('div.destroy').unbind().click(function () {
                $.post($(this).data('destroyurl'), '', function(response) {
                    if(response.status) {
                        $('#menu_'+response.removedId).remove();
                    }
                });
            });
        }
    </script>
@endpush