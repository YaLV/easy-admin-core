


jQuery(document).ready(function($) {
    'use strict';

    // ============================================================== 
    // Notification list
    // ============================================================== 
    if ($(".notification-list").length) {

        $('.notification-list').slimScroll({
            height: '250px'
        });

    }

    // ============================================================== 
    // Menu Slim Scroll List
    // ============================================================== 


    if ($(".menu-list").length) {
        $('.menu-list').slimScroll({

        });
    }

    // ============================================================== 
    // Sidebar scrollnavigation 
    // ============================================================== 

    if ($(".sidebar-nav-fixed a").length) {
        $('.sidebar-nav-fixed a')
            // Remove links that don't actually link to anything

            .click(function(event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top - 90
                        }, 1000, function() {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                        });
                    }
                };
                $('.sidebar-nav-fixed a').each(function() {
                    $(this).removeClass('active');
                })
                $(this).addClass('active');
            });

    }

    // ============================================================== 
    // tooltip
    // ============================================================== 
    if ($('[data-toggle="tooltip"]').length) {

            $('[data-toggle="tooltip"]').tooltip()

        }

     // ==============================================================
    // popover
    // ============================================================== 
       if ($('[data-toggle="popover"]').length) {
            $('[data-toggle="popover"]').popover()

    }
     // ==============================================================
    // Chat List Slim Scroll
    // ============================================================== 


        if ($('.chat-list').length) {
            $('.chat-list').slimScroll({
            color: 'false',
            width: '100%'


        });
    }
    // ============================================================== 
    // dropzone script
    // ============================================================== 

 //     if ($('.dz-clickable').length) {
 //            $(".dz-clickable").dropzone({ url: "/file/post" });
 // }

});


jQuery(document).on({
    ajaxStart: function () {
        if (!jQuery('body').hasClass('noLoading')) {
            jQuery('body').addClass("loading");
        }
    },
    ajaxStop: function () {
        jQuery('body').removeClass("loading");
    }
});

jQuery.ajaxSetup({
    beforeSend:  function (xhr) {
        csrf_token = window.token;
        xhr.setRequestHeader('X-CSRF-TOKEN', csrf_token)
    },
    error: function (xhr, textStatus, error) {
        // Validation Exception
        if (xhr.status === 422) {
            messages = [];
            message = xhr.responseJSON.errors;
            for (x in message) {
                messages.push("<li>" + message[x][0] + "</li>");
            }

            svaigi.showMessage('<ul style="list-style-position:outside;list-style-type:disc;display:block;">' + messages.join("") + '</ul>', 'error');
            return;
        }

/*
        // unauthorized
        if (xhr.status === 401) {
            document.location = "/sessionEnded";
            return;
        }
*/

        if (xhr.status === 500 || xhr.status === 419) {
            svaigi.showMessage('Server Error, please contact System administrator', 'error');
        }

        return;
    },
    complete: function(xhr, textStatus, error) {
        if(xhr.responseJSON.noMessage) return;
        if(xhr.status === 200) {
            svaigi.showMessage(xhr.responseJSON.message||'Changes have been made', 'success');
        }
    }
});

jQuery.ajaxPrefilter(function(options, originalOptions, jqXHR){
    if (options.type.toLowerCase() === "post") {
        csrf_token = window.token;
        if(typeof options.data == "object") {
            options.data.append('_token', encodeURIComponent(csrf_token));
        } else {
            options.data = options.data || "";
            options.data += options.data ? "&" : "";
            options.data += "_token=" + encodeURIComponent(csrf_token);
        }
    }
});
