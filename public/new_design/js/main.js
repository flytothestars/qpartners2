function addItemToBasket(tag_object) {
    var method = $(tag_object).data('method');
    var item_id = $(tag_object).data('item-id');
    var user_id = $(tag_object).data('user-id');
    if (user_id) {
        ajax(method, item_id, user_id);
    } else {
        window.location.href = 'http://local.qpartners.club/kz/login';
    }
}


function ajax(method, item_id, user_id) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{route('basket.isAjax')}}",
        type: "POST",
        data: {
            _token: CSRF_TOKEN,
            method_name: method,
            item_id: item_id,
            user_id: user_id,
        },
        success: function (data) {
            if (method == 'delete') {
                $("#product-section").load(location.href + " #product-section");
                $("#total-price-div").load(location.href + " #total-price-div");
            } else if (data.method == 'add') {
                if (data.success == 1) {
                    $.notify(data.message, "success");
                } else if (data.success == -1) {
                    $.notify(data.message, "error");
                } else if (data.success == 0) {
                    $.notify(data.message, "error");
                }
                $("#basket-box").load(location.href + " #basket-box");
            }
        }
    });
}