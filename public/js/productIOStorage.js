var updateStorageLine = function(response) {
  row = $('[data-id='+response.data.product_id+']');

  row.find('[name=info]').val(response.data.info);
  row.find('[name=amount]').val("");
  row.find('.currentAmount').val(response.data.storage_amount);
};

jQuery(document).ready(function () {
    jQuery('a.ajaxUpdate').click(function(e) {
        e.preventDefault();
        url = $(this).attr('href');
        data = $(this).prev().val();
        fieldName = $(this).prev().attr('name');
        fieldData = fieldName+"="+data;
        fieldData+="&product_id="+$(this).parents('[data-id]').attr('data-id');

        sendPost(url, fieldData, updateStorageLine);
        return false;
    });

    jQuery('input.ajaxUpdate').keyup(function(e) {
        if(e.keyCode===13) {
            url = $(this).next().attr('href');
            data = $(this).val();
            fieldName = $(this).attr('name');
            fieldData = fieldName+"="+data;
            fieldData+="&product_id="+$(this).parents('[data-id]').attr('data-id');

            sendPost(url, fieldData, updateStorageLine);
        }
    })
});

function sendPost(url, data, callback) {
    $.post(url, data, function(response) { callback(response); });
}

