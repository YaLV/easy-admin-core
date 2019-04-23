var checkTexts = ['All', 'None'];

$(document).ready(function () {
    bindOrderUpdates();
});

function bindOrderUpdates() {

    $('.checkall a').unbind().click(function (e) {
        newState = true;
        if (isCheckedAll()) {
            newState = false;
        }

        checkboxes = $('input[type=checkbox].massAction');
        console.log(checkboxes);

        checkboxes.prop('checked', newState);
        $(this).text(checkTexts[Number(newState)]);
    });
    $('input[type=checkbox].massAction').unbind().click(function () {
        if (isCheckedAll()) {
            $('.checkall a').text('None');
        } else {
            $('.checkall a').text('All');
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

    console.log(rowCount);
    console.log(checkedCount);

    return rowCount == checkedCount;
}