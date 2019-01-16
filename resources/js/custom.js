jQuery(document).ready(function(){
    jQuery('.stateButton').click(function(e) {
        button = jQuery(this);
        jQuery.post(button.attr('href'), "", function(response) {
           if(response.status==true) {
               button.parents('tr').toggleClass('text-muted text-dark');
               button.find('i').toggleClass('fa-eye fa-eye-slash');
           }
        });
        e.preventDefault();
        return false;
    });

    jQuery('.submitButton').click(function(e) {
        e.preventDefault();
        jQuery(this).closest('form').submit();
        return false;
    });

    jQuery(".datepicker").datepicker({
        firstDay: 1
    });

    jQuery(".destroyButton").click(function(e) {
        e.preventDefault();

        button = $(this);

        if(button.data('message')) {
            if(!confirm(button.data('message'))) {
                return false;
            }
        }

        jQuery.post(button.attr('href'),"",function(response) {
             if(response.status) {
                 button.parents('tr').remove();
             }
        });
        return false;
    })
});