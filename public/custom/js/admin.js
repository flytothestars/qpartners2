/**
 * Created by Arman-PC on 21.12.2016.
 */

KindEditor.ready(function (K) {
    K.create('.text_editor', {

        cssPath: [''],
        autoHeightMode: true, // это автоматическая высота блока
        afterCreate: function () {
            this.loadPlugin('autoheight');
        },
        allowFileManager: true,
        items: [// Вот здесь задаем те кнопки которые хотим видеть
            'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
            'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
            'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
            'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
            'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
            'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
            'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'deliverybreak',
            'anchor', 'link', 'unlink', 'map', '|', 'about'
        ]
    });
    //Ниже инициализируем доп. например выбор цвета или загрузка файла
    var colorpicker;
    K('#colorpicker').bind('click', function (e) {
        e.stopPropagation();
        if (colorpicker) {
            colorpicker.remove();
            colorpicker = null;
            return;
        }
        var colorpickerPos = K('#colorpicker').pos();
        colorpicker = K.colorpicker({
            x: colorpickerPos.x,
            y: colorpickerPos.y + K('#colorpicker').height(),
            z: 19811214,
            selectedColor: 'default',
            noColor: 'Очистить',
            click: function (color) {
                K('#color').val(color);
                colorpicker.remove();
                colorpicker = null;
            }
        });
    });
    K(document).click(function () {
        if (colorpicker) {
            colorpicker.remove();
            colorpicker = null;
        }
    });

    var editor = K.editor({
        allowFileManager: true
    });
});

$('.datetimepicker-input').datetimepicker({
    format: 'DD.MM.YYYY HH:mm'
});

$('.datetimepicker-input').on('dp.show', function () { // Hack datepicker position
    var datepicker = $(this).siblings('.bootstrap-datetimepicker-widget');
    if (datepicker.hasClass('top')) {
        var top = $(this).offset().top - datepicker.height() - 130;
        datepicker.css({'top': top + 'px', 'bottom': 'auto'});
    }
});

$("#image_form").submit(function (event) {
    event.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: '/image/upload',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('.ajax-loader').css('display', 'none');
            if (data.success == 0) {
                showError(data.error);
                return;
            }
            $('.image-name').val(data.file_name);
            $('.image-src').attr('src', data.file_name);

        }
    });
});

$("#images_form").submit(function (event) {
    event.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: '/images/upload',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            var array = [];
            $('.ajax-loader').css('display', 'none');
            if (data.success == 0) {
                showError(data.error);
                return;
            }
            $.each(data.file_name, function (i) {
                array.push(data.file_name[i]);
                $('.multiple-images-list').append(
                    '         <div class="row row-images-list" >\n' +
                    '                           <div class="col-sm-3 image-box" style="\n' +
                    '                                background-image: url(' + data.file_name[i] + ');\n' +
                    '                                ">\n' +
                    '                                </div>\n' +
                    '                                <div class="col-sm-6">\n' +
                    '                                    <p class="image-name"></p>\n' +
                    '                                </div>\n' +
                    '                                <div class=" col-sm-2 image-trash">\n' +
                    '                                    <a href=""><i class="fa fa-trash" >\n' +
                    '                                    </i></a>\n' +
                    '                                </div>  </div> '
                );
            });
            $('#images-name').val(array);
            // $('.image-src').attr('src', data.file_name);

        }
    });
});

function uploadImage() {
    $('.ajax-loader').css('display', 'block');
    $("#image_form").submit();
}

function uploadMultipleImages() {
    $('.ajax-loader').css('display', 'block');
    $('.images-src').css('display', 'none');
    $("#images_form").submit();
}

function searchBySort() {
    href = '?search=' + $('#search_word').val();
    window.location.href = href;
}

$("#search_word").keyup(function (event) {
    if (!event.ctrlKey && event.which == 13) {
        searchBySort();
    }
});

function isShowDisabledAll(model) {
    if (confirm('Действительно хотите сделать неактивным?')) {
        $('.ajax-loader').fadeIn(100);
        $('.select-all').each(function () {
            if ($(this).is(':checked')) {
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        is_show: 0,
                        id: $(this).val()
                    },
                    url: "/admin/" + model + "/is_show",
                    success: function (data) {

                    }
                });
                $(this).closest('tr').remove();
            }
        });
        $('.ajax-loader').fadeOut(100);
    }
}

function isShowEnabledAll(model) {
    if (confirm('Действительно хотите сделать активным?')) {
        $('.ajax-loader').fadeIn(100);
        $('.select-all').each(function () {
            if ($(this).is(':checked')) {
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        is_show: 1,
                        id: $(this).val()
                    },
                    url: "/admin/" + model + "/is_show",
                    success: function (data) {

                    }
                });
                $(this).closest('tr').remove();
            }
        });
        $('.ajax-loader').fadeOut(100);
    }
}

function deleteAll(model) {
    if (confirm('Действительно хотите удалить?')) {
        $('.ajax-loader').fadeIn(100);
        $('.select-all').each(function () {
            if ($(this).is(':checked')) {
                $.ajax({
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/" + model + "/" + $(this).val(),
                    success: function () {

                    }
                });
                $(this).closest('tr').remove();
            }
        });
        $('.ajax-loader').fadeOut(100);
    }
}

function selectAllCheckbox(ob) {
    if ($(ob).is(':checked')) {
        $('.select-all').prop('checked', true);
    } else {
        $('.select-all').prop('checked', false);
    }
}

function delItem(ob, id, model) {
    if (confirm('Действительно хотите удалить?')) {
        $(ob).closest('tr').remove();
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/admin/" + model + "/" + id,
            success: function (data) {
            }
        });
    }
}

function isShow(ob, id, model) {
    var is_show = 0;
    if ($(ob).is(':checked')) {
        is_show = 1;
    }
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            is_show: is_show,
            id: id
        },
        url: "/admin/" + model + "/is_show",
        success: function (data) {

        }
    });
}

var cw = $('#avatar_img').width();
$('#avatar_img').css('height', cw);

$('.news-lang').change(function () {
    $('.lang-item').fadeOut(100);
    $('.add-lang-item').fadeIn(100);
    $('#lang_' + this.value).fadeIn(100);
    $('#add_lang_' + this.value).fadeOut(100);
    $('.ke-container').css('width', '100%');
});

function showLang(lang) {
    $('#add_lang_' + lang).fadeOut(100);
    $('#lang_' + lang).fadeIn(100);
    $('.ke-container').css('width', '100%');
}


function saveNews() {
    $("#news_form").submit();
}

$("#news_form").submit(function (event) {
    event.preventDefault();

    $.ajax({
        url: '/admin/news/save',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            news_id: $('#news_id').val(),
            news_name_ru: $('#news_name_ru').val(),
            news_text_ru: $('#lang_ru').find('.ke-container').find("iframe").contents().find("body").html(),
            news_name_kz: $('#news_name_kz').val(),
            news_text_kz: $('#lang_kz').find('.ke-container').find("iframe").contents().find("body").html(),
            news_name_en: $('#news_name_en').val(),
            news_text_en: $('#lang_en').find('.ke-container').find("iframe").contents().find("body").html(),
            news_lang: $('#news_lang').val(),
            news_image: $('#news_image').val(),
            tag: $('#tag').val(),
            video_url: $('#video_url').val(),
            source_name: $('#source_name').val(),
            source_url: $('#source_url').val(),
            news_date: $('#news_date').val()
        },
        success: function (data) {
            $('.ajax-loader').fadeOut(100);
            if (data.success == 0) {
                $('#news_error').fadeIn(100);
                $('#news_error').html(data.result);
                return;
            }

            if (data.success == true) {
                window.location.href = '/admin/news';
            } else {
                $('#news_id').val(data.news_id);
            }

        }
    });
});

$('a.fancybox').fancybox({
    padding: 10
});

$(function () {
    $(".phone-mask").mask("+7(999)9999999");
});

$('.table-css input').change(function () {
    $(this).closest('form').submit();
});

function getReadMorePacket(id) {
    $.ajax({
        type: 'GET',
        url: "/admin/packet/" + id,
        success: function (data) {
            $('#modal_desc').html(data.image);
            $('#modal_title').html(data.title);
            //$('#shop_modal').fadeIn(0);
            //$('#blur').fadeIn(0);

            $('a.fancybox').fancybox({
                padding: 10
            });
            $('.fancybox').click();
        }
    });
}

function addProductToBasket(id) {
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/admin/online/" + id,
        success: function (data) {
            if (data.status == true) {
                showMessage('Успешно добавлено');
                $('#basket_count').html(data.count);
            } else {
                showError(data.error);
            }
        }
    });
}

function setBasketUnit(ob, id) {
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/admin/online/unit/" + id,
        data: {
            unit: $(ob).val()
        },
        success: function (data) {
            if (data.status == true) {
                $('#sum').html(data.sum);
                $('#ballSum').html(data.ballSum);
            } else {
                showError(data.error);
            }
        }
    });
}

function confirmBasket() {
    let discount_type = $('#discount_type').val();
    let address = $('#address').val();
    let delivery_id = $('#delivery').val();
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {type: discount_type, address: address, delivery_id: delivery_id},
        url: "/admin/online/confirm",
        success: function (data) {
            if (data.status == true) {
                window.location.href = '/admin/online/history';
            } else {
                showError(data.error);
            }
        }
    });
}

function setSuperBalance() {        
    console.log($('#discount_type').val('is_super'))
    confirmBasket();
}


function delProductFromBasket(ob, id) {
    $(ob).closest('tr').remove();

    $.ajax({
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/admin/online/" + id,
        success: function (data) {
            if (data.status == true) {
                showMessage('Успешно удалено');
                $('#basket_count').html(data.count);
                $('#sum').html(data.sum);
            } else {
                showError(data.error);
            }
        }
    });
}

function closeModal() {
    $('.modal-dialog').css('display', 'none');
    $('#blur').css('display', 'none');
}

function getReadMoreProduct(ob) {
    $('#modal_title').html($(ob).closest('.info-box-content').find('.info-box-text').html());
    $('#modal_desc').html($(ob).closest('.info-box-content').find('.info-box-desc').html());
    $('#shop_modal').fadeIn(0);
    $('#blur').fadeIn(0);
}

function showBasketModal() {
    $('#modal_desc').html($('#sum').html());
    $('#shop_modal').fadeIn(0);
    $('#blur').fadeIn(0);
}


function subscribeInstagram(ob, user_id, instagram) {
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/admin/instagram/send",
        data: {
            user_id: user_id
        },
        success: function (data) {
            if (data.status == true) {
                $(ob).css('background-color', '#F9BF3B');
                $(ob).html('Отправлено');
                window.location.href = instagram;
            } else {
                showError(data.error);
            }
        }
    });
}

function subscribeInstagramPartner(ob, instagram_id, instagram) {
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/admin/instagram/send/partner",
        data: {
            instagram_id: instagram_id
        },
        success: function (data) {
            if (data.status == true) {
                $(ob).css('background-color', '#F9BF3B');
                $(ob).html('Отправлено');
                window.location.href = instagram;
            } else {
                showError(data.error);
            }
        }
    });
}


function acceptInstagram(ob, id) {
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/admin/instagram/accept",
        data: {
            id: id
        },
        success: function (data) {
            if (data.status == true) {
                $(ob).css('background-color', '#F9BF3B');
                $(ob).html('Принято');
            } else {
                showError(data.error);
            }
        }
    });
}

function rejectInstagram(ob, id) {
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/admin/instagram/reject",
        data: {
            id: id
        },
        success: function (data) {
            if (data.status == true) {
                $(ob).css('background-color', '#F9BF3B');
                $(ob).html('Отклонено');
            } else {
                showError(data.error);
            }
        }
    });
}

function buyProductOnline() {
    if(confirm('Действительно хотите купить онлайн?')) {
        let discount_type = $('#discount_type').val();
        let address = $('#address').val();
        let delivery_id = $('#delivery').val();
        document.getElementById('ajax-loader').style.display='block';
        $.ajax({
            url: '/smartpay/create_order_partner_product',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                address: address,
                delivery_id: delivery_id,
                type: discount_type,                                
            },
            beforeSend: function() {
                closeModal();
            },
            success: function (data) {
                document.getElementById('ajax-loader').style.display='none';
                if (data.status == false) {
                    showError(data.message);
                    return;
                }
                else {
                    // console.log(data)
                    window.location.replace(data.url);
                }
            }
        });
    }
}

