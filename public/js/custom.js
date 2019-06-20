jQuery(document).ready(function () {
    $('body').removeClass("loading");
    bindStuff();
});

function replaceTable(response) {
    if (response.hasOwnProperty("replaceTable")) {
        $('div.tableContent').replaceWith(response.replaceTable);
        bindStuff();
    }
}

function bindStuff() {
    jQuery('.isAjax').unbind().click(function (e) {
        el = jQuery(this);
        e.preventDefault();
        url = el.attr('href') || el.attr('data-href');

        parameters = "";
        if (el.attr('data-params')) {
            paramFn = eval(el.attr('data-params'));
            parameters = paramFn(el);
        }

        if (el.hasClass('post')) {
            jQuery.post(url, parameters, function (response) {
                if(el.hasClass('massAction')) {
                    clearMassAction();
                }

                if (el.attr('data-callback')) {
                    fn = eval(el.attr('data-callback'))
                    fn(response);
                }
            });
        } else {
            jQuery.get(url, parameters, function (response) {
                if(el.hasClass('massAction')) {
                    clearMassAction();
                }

                if (el.attr('data-callback')) {
                    fn = eval(el.attr('data-callback'))
                    fn(response);
                }
            });
        }
        return false;
    });


    jQuery('.stateButton').unbind().click(function (e) {
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

    jQuery('.submitButton').unbind().click(function (e) {
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

    jQuery(".destroyButton").unbind().click(function (e) {
        e.preventDefault();

        button = $(this);

        if (button.data('message')) {
            if (!confirm(button.data('message'))) {
                return false;
            }
        }

        jQuery.post(button.attr('href'), "", function (response) {
            if (response.status == true) {
                if (response.hasOwnProperty("replaceTable")) {
                    $('div.tableContent').replaceWith(response.replaceTable);
                    bindStuff();
                } else {
                    button.parents('tr').remove();
                }
            }
        });
        return false;
    })

    $('select.multiselect').multiSelect();

    $('.editTranslation').unbind().click(function () {
        $.get(editUrl.replace("ID", $(this).data('id')), '', function (response) {
            showTranslation(response);
        });
    })


    $('#custom-search input').unbind().keyup(function (e) {
        if (e.keyCode == 13) {
            document.location = searchUrl.replace('ID', $(this).val());
        }
    });
}

function clearMassAction() {
    $('input[type=checkbox].massAction').prop('checked', false);
}


var imageControlTemplate = '<div class="controls">' +
    '<a href="#" class="btn btn-xs btn-info setMainImage" data-file><i class="fas mainImage"></i></a>' +
    '<a href="#" class="btn btn-xs btn-danger removeImage" data-file><i class="fas fa-trash-alt"></i></a>' +
    '</div>';

jQuery(document).ready(function () {

    tinymce.init({
        selector: 'textarea:not(.noEditor)',
        plugins: "image imagetools colorpicker hr table link textcolor code paste lists autolink anchor contextmenu insertdatetime",
        force_br_newlines: true,
        force_p_newlines: false,
        forced_root_block: '',
        entity_encoding : "raw",
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
        resetform = false;
        fileData = new FormData;
        fileId = jQuery(this).attr('id');

        files = jQuery(this)[0].files;
        if ($(this).hasClass('defaultUpload')) {
            for (x in files) {
                fileData.append(jQuery(this).attr('name') + "[]", files[x]);
            }
        } else {
            fileData.append(jQuery(this).attr('name'), files[0]);
            resetform = true;
        }
        fileData.append('path', jQuery('.preview[data-file=' + fileId + ']').attr('data-path'));
        fileData.append('owner', jQuery(this).attr('name'));
        if($(this).data('lang')) {
            fileData.append('language', jQuery(this).data('lang'));
        }

        if (form = jQuery(this).parents('form')) {
            fields = form.find('input:not([type=file])');
            fields.each(function () {
                fld = jQuery(this);
                fileData.append(fld.attr('name'), fld.val());
            });
        }

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
                if (resetform) {
                    form[0].reset();
                }
                bindButtons();
            }
        });
    });
    $('input[type=text].slugify').blur(function () {
        language = $(this).data('language');
        console.log(language);

        $.post('/admin/slugify', 'slugify=' + $(this).val(), function (response) {
            if (response.status) {
                if (typeof language === "undefined") {
                    $('input[type=text].slug').val(response.slug);
                } else {
                    $('input[type=text].slug[data-language=' + language + ']').val(response.slug);
                }
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

function showTranslation(result) {
    form = $('#post' + modalID);
    form.find('input').val("");
    for (y in result.translation.meta_data) {
        form.find('input[data-transFor=' + result.translation.meta_data[y].language + ']').val(result.translation.meta_data[y].meta_value);
    }
    $('.saveTranslation').unbind().click(function () {
        $.post(storeUrl.replace("ID", result.translation.id), form.serialize(), function (result) {
            if (result.status) {
                $("[data-id=" + result.lineID + "] .transVal").text(result.edited);
                $('#modalWin' + modalID).modal("hide");
            }
        });
    });
    $('#modalWin' + modalID).modal("show");
}


/*
    Searchable textfield
 */
$(function () {

    function split(val) {
        return val.split(/,\s*/);
    }

    function extractLast(term) {
        return split(term).pop();
    }

    $('.changeDT').on('changed.bs.select', function () {
        $('.autocomplete.target').val("");
    });

    $(".autocomplete")
    // don't navigate away from the field on tab when selecting an item
        .on("keydown", function (event) {
            if (event.keyCode === $.ui.keyCode.TAB &&
                $(this).autocomplete("instance").menu.active) {
                event.preventDefault();
            }
        })
        .autocomplete({
            source: function (request, response) {
                $.getJSON($('input.autocomplete:focus').data('searchurl').replace("discount_to", $('.changeDT').selectpicker('val')), {
                    term: extractLast(request.term)
                }, response);
            },
            search: function () {
                // custom minLength
                var term = extractLast(this.value);
                if (term.length < 2) {
                    return false;
                }
            },
            focus: function () {
                // prevent value inserted on focus
                return false;
            },
            select: function (event, ui) {
                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.value);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(", ");
                return false;
            }
        });
});

function reloadPage(response) {
    if (response.status) {
        document.location = document.location.pathname;
    }
}

function getForm(el) {
    form = el.attr('data-form');

    return jQuery(form).serialize();
}

function getCheckedRows() {
    var checkedRows = [];
    $('input[type=checkbox].massAction:checked').each(function() {
        checkedRows.push("massAction[]="+$(this).val());
    });

    return checkedRows.join('&');
}

function showLogModal(data) {
    jQuery('#logModal .modal-body').html(data.data);
    jQuery('#logModal').modal();
}


$(document).on({
    ajaxStart: function () {
        if (!$('body').hasClass('noLoading')) {
            $('body').addClass("loading");
        }
    },
    ajaxStop: function () {
        $('body').removeClass("loading");
    }
});

window.onbeforeunload = function (event) {
    $('body').addClass("loading");
    setTimeout(function () {
        $('body').removeClass("loading");
    }, 3000);
};
