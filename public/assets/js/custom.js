$(document).ready(function () {
   // Show Legal Forms
   $('#is_legal').change(function(e){
      if($(this).is(":checked")) {
          $('#legalform').removeClass('hidden');
          return true;
      }
      $('#legalform').addClass('hidden');
   });
});