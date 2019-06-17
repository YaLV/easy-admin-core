$(document).ready(function () {
   // Show Legal Forms
   $('#is_legal').change(function(e){
      if($(this).is(":checked")) {
          $('#legalform').removeClass('hidden');
          return true;
      }
      $('#legalform').addClass('hidden');
   });

    jQuery(document).keyup(function(e) {
        if(e.keyCode===27 && jQuery('body').hasClass('sv-lightbox-open')) {
            jQuery('div.sv-lightbox-open .sv-close').click();
        }
    });

    jQuery('.reportClose').click(function(e) {
        e.preventDefault();
        jQuery.post($(this).data('url'));
        el = $(this).parents('.sv-message');
        if(el) {
            el.hide('blind', {}, 500, function () {
                el.remove();
            });
        }
        return false;
    })
    addToCart();
});


function addToCart() {
    $('.sv-product-card form, .sv-product-title form').unbind().submit(function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serialize(), function(response) {
            if(response.status) {
                showCartAlert();
                showCartTotals(response);
                return false;
            }
            alert(response.message);
            return false;
        });
        return false;
    });
}

function showCartTotals(response) {
    $('.minicart-totals').text(response.contents.cartTotals.toPay+" €");
    $('.cart').addClass('has-items');
}