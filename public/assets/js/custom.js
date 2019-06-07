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

});