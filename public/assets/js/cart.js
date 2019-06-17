$(document).ready(function () {
    bindRemove();
    bindUpdate();
});


function bindRemove() {
    $('.discard').unbind().click(function (e) {
        e.preventDefault();
        $.post($(this).attr('href'), '', function (response) {
            if (response.status === true) {
                redrawCart(response);
                bindRemove();
                bindUpdate();
            }
        });
    });
}


function bindUpdate() {
    $('.updateCartProduct').unbind().click(function (e) {
        el = $(this);
        $('.sv-cart > .list').addClass('loading-items');
        e.preventDefault();
        $.post($(this).attr('href'), $(this).closest('form').serialize(), function (response) {
            redrawCart(response);
            showCartTotals(response);
            bindRemove();
            bindUpdate();
            $('.sv-cart > .list').removeClass('loading-items');
            if (!response.status) {
                alert(response.message);
            }
        });
    });

    $('.setDelivery').unbind().click(function(e) {
        $('.sv-cart-tabs').addClass('loading-items');

        el = jQuery(this);
        $.get($(this).data('run'), function(response) {
            $('.sv-cart-tabs').removeClass('loading-items');
            if(response.status) {
                jQuery('.sv-cart-tabs .tab').removeClass('active');
                el.addClass('active');
                redrawCart(response);
                showCartTotals(response);
                bindRemove();
                bindUpdate();
                return;
            }
            alert(response.message);
        });
        e.preventDefault();
        return false;
    })


}

function redrawCart(response) {
    list = $('.sv-cart>.list');
    $('.minicart-contents').html(response.contents.miniItems);
    list.children(":not(.header, .coupon, .sv-blank-spacer)").remove();
    $(response.contents.items).insertAfter('.header');
    totals = $('.sv-cart>.sticky .totals');
    cartTotals = response.contents.cartTotals;
    for (x in cartTotals) {
        totals.find("." + x).html(cartTotals[x] + ' €');
    }
    $('.selectpicker').selectric();
    jQuery('#spinner, .spinner').spinner({
        min: 1,
        max: 5,
        step: 1,
        numberFormat: "n"
    });
}