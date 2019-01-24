jQuery(document).ready(function () {
    jQuery('.stateButton').click(function (e) {
        button = jQuery(this);
        jQuery.post(button.attr('href'), "", function (response) {
            if (response.status == true) {
                button.parents('tr').toggleClass('text-muted text-dark');
                button.find('i').toggleClass('fa-eye fa-eye-slash');
            }
        });
        e.preventDefault();
        return false;
    });

    jQuery('.submitButton').click(function (e) {
        e.preventDefault();
        jQuery(this).closest('form').submit();
        return false;
    });

    jQuery(".datepicker").datepicker({
        weekStart: 1,
        orientation: "bottom left",
        todayHighlight: true,
        startDate: new Date(),
        autoclose: true
    });

    jQuery(".destroyButton").click(function (e) {
        e.preventDefault();

        button = $(this);

        if (button.data('message')) {
            if (!confirm(button.data('message'))) {
                return false;
            }
        }

        jQuery.post(button.attr('href'), "", function (response) {
            if (response.status==true) {
                button.parents('tr').remove();
            }
        });
        return false;
    })

    $('select.multiselect').multiSelect();
});


var imageControlTemplate = "<div class='controls'>" +
    "<a href='#' class='btn btn-xs btn-info setMainImage' data-file><i class='fas mainImage'></i></a>" +
    "<a href='#' class='btn btn-xs btn-danger removeImage' data-file><i class='fas fa-trash-alt'></i></a>" +
"</div>";

jQuery(document).ready(function () {

    tinymce.init({
        selector:'textarea',
        plugins: "image imagetools colorpicker hr table link textcolor code paste lists autolink anchor contextmenu insertdatetime",
        force_br_newlines : true,
        force_p_newlines : false,
        forced_root_block : '',
        toolbar: [
            "code | undo redo | formats | bold italic | fontselect | fontsizeselect | hr alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor | anchor",
            ],
        insertdatetime_formats: [
            "%H:%M:%S",
            ""
        ]
    });

    jQuery('.preview').each(function () {
        id = jQuery(this).attr('data-file');
        jQuery(this).find('.preview_image_container').each(function () {
            controls = jQuery(imageControlTemplate).clone();
            isMain = jQuery(this).find('.imMain').val();
            controls.find('.mainImage').addClass(isMain == 1 ? "fa-thumbs-up" : "fa-thumbs-down");
            controls.find('[data-file]').attr('data-file', id);
            jQuery(this).append(controls);
        });
    });

    bindButtons();

    jQuery('input[type=file]').change(function () {
        fileData = new FormData;
        fileId = jQuery(this).attr('id');

        files = jQuery(this)[0].files;
        for (x in files) {
            fileData.append(jQuery(this).attr('name') + "[]", files[x]);
        }
        fileData.append('path', jQuery('.preview[data-file=' + fileId + ']').attr('data-path'));
        fileData.append('owner', jQuery(this).attr('name'));


        jQuery.ajax({
            url: "/admin/uploadFile",
            type: "POST",
            data: fileData,
            contentType: false,//"multipart/form-data",
            cache: false,
            processData: false,
            success: function (containers) {
                for (x in containers.data) {
                    container = jQuery(containers.data[x]);

                    controls = jQuery(imageControlTemplate).clone();
                    isMain = container.find('.imMain').val();
                    controls.find('.mainImage').addClass("fa-thumbs-down");
                    controls.find('[data-file]').attr('data-file', id);
                    container.append(controls);
                    jQuery('.preview[data-file=' + fileId + ']').append(container);
                }
                bindButtons();
            }
        });
    });
    $('input[type=text].slugify').blur(function () {
        language = $(this).data('language');
        console.log(language);

        $.post('/admin/slugify', 'slugify=' + $(this).val(),function(response) {
            if(response.status) {
                $('input[type=text].slug[data-language='+language+']').val(response.slug);
            }
        });
    });
});

function bindButtons() {
    jQuery('.removeImage').unbind().click(function (e) {
        e.preventDefault();
        jQuery(this).parents('.preview_image_container').remove();
        return false;
    });

    jQuery('.setMainImage').unbind().click(function (e) {
        e.preventDefault();
        id = jQuery(this).parents('.preview').attr('data-file');
        block = jQuery(this).parents('.preview_image_container');
        jQuery('[data-file=' + id + '] .mainImage').removeClass('fa-thumbs-up').addClass('fa-thumbs-down');
        jQuery('.preview[data-file=' + id + ']').find('.preview_image .imMain').val("0");
        block.find('.imMain').val("1");
        jQuery(this).find('.mainImage').toggleClass('fa-thumbs-up fa-thumbs-down');
        return false;
    });
}