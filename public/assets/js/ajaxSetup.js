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