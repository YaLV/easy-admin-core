jQuery(document).ready(function () {
    jQuery('.importProducts').click(function (e) {
        e.preventDefault();
        jQuery('#uploadfile').click();
    });
});