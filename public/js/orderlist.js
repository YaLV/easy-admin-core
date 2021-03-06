var checkTexts = ['All', 'None'];

$(document).ready(function () {
    bindOrderUpdates();
});

function showMassButtons() {
    $('div.massActionGroup').show();
}

function hideMassButtons() {
    $('div.massActionGroup').hide();
}

function bindOrderUpdates() {

    $('div.massActionGroup').hide();

    $('textarea.autosave').keyup(function () {

        if(!$(this).data('event')) {
            $(this).data('event', 1);
            el = $(this);
            $(this).blur(function () {
                $.post(orderUpdateUrl, 'update=' + $(this).attr('name') + '&' + $(this).attr('name') + "=" + $(this).val(), function() {
                    el.data('event', null);
                    el.unbind('blur');
                });
            });
        }
    });

    $('.checkall a').unbind().click(function (e) {
        newState = true;
        if (isCheckedAll()) {
            newState = false;
        }

        checkboxes = $('input[type=checkbox].massAction');

        checkboxes.prop('checked', newState);
        if($('input[type=checkbox].massAction:checked').length) {
            showMassButtons();
        } else {
            hideMassButtons();
        }
        $(this).text(checkTexts[Number(newState)]);
    });

    $('input[type=checkbox].massAction').unbind().click(function () {
        if (isCheckedAll()) {
            $('.checkall a').text('None');
        } else {
            $('.checkall a').text('All');
        }
        if($('input[type=checkbox].massAction:checked').length) {
            showMassButtons();
        } else {
            hideMassButtons();
        }

    });

    $('.paidinput, .amountinput').unbind().keyup(function (e) {
        if (e.keyCode === 13) {
            $(this).next().click();
            return false;
        }

        if ($(this).val() != $(this).data('origvalue')) {
            $(this).next().removeClass('invisible');
        } else {
            $(this).next().addClass('invisible');
        }
    });

    $('.changeState').unbind().change(function () {
        $.post($(this).data('url'), 'newState=' + $(this).val(), function (response) {

        });
    });

    $('.changeDelivery').unbind().change(function () {
        $.post($(this).data('url'), 'delivery=' + $(this).val(), function (response) {
            if (response.hasOwnProperty('orderContent') && $('#orderContent').length) {
                $('#orderContent').html(response.orderContent);
            }
            bindOrderUpdates();
        });
    });

    $('.setPaid').click(function (e) {
        el = $(this);
        e.preventDefault();
        $.post(el.attr('href'), "amount=" + el.prev().val(), function (response) {
            inp = el.prev();

            inp.val(response.amount);
            inp.data('origvalue', response.amount);
            inp.trigger('keyup');

            if (response.hasOwnProperty('orderContent') && $('#orderContent').length) {
                $('#orderContent').html(response.orderContent);
            }
            bindOrderUpdates();

        });
        return false;
    });

    $('.setCorrectAmount').click(function (e) {
        el = $(this);
        e.preventDefault();
        $.post(el.attr('href'), "amount=" + el.prev().val(), function (response) {
            inp = el.prev();

            inp.val(response.amount);
            inp.data('origvalue', response.amount);
            inp.trigger('keyup');

            if (response.hasOwnProperty('orderContent') && $('#orderContent').length) {
                $('#orderContent').html(response.orderContent);
            }
            bindOrderUpdates();

        });
    })
}


function isCheckedAll() {
    rowCount = $('.table.table-hover tbody tr').length||$('.prodrow').length;
    checkedCount = $('tbody tr input[type=checkbox]:checked').length||$('.prodrow input[type=checkbox]:checked').length;

    return rowCount == checkedCount;
}