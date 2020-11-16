$(function() {
    $(".phone-mask").mask("+7(999)9999999");
});

$(function() {
    $(".card-mask").mask("9999-9999-9999-9999");
});

$(function() {
    $(".iban-mask").mask("KZ** **** **** **** ****");
});

function writeMessage() {
    $.ajax({
        url: '/contact',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            user_name: $('#user_name').val(),
            email: $('#user_email').val(),
            message: $('#message').val()
        },
        success: function (data) {
            if (data.status == false) {
                showError(data.message);
                return;
            }
            else {
                $('#message').val('');
                showMessage(data.message);
            }
        }
    });
}
function showError(message){
    $.gritter.add({
        title: '',
        text: message
    });
    return false;
}

function showMessage(message){
    $.gritter.add({
        title: '',
        text: message,
        class_name: 'success-gritter'
    });
    return false;
}

function showLimitMessage() {
    $.gritter.add({
        title: '',
        text: 'Для покупки этого пакета вы должны купить один из Premium, Elite, VIP пакетов',
        class_name: 'success-gritter'
    });
    return false;
}



function addResponseAddPacket(ob,packet_id,user_packet_type){
    if(confirm('Действительно хотите отправить запрос?')) {
        document.getElementById('ajax-loader').style.display='block';
        $.ajax({
            url: '/admin/packet/user',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                packet_id: packet_id,
                user_packet_type: user_packet_type
            },
            success: function (data) {
                document.getElementById('ajax-loader').style.display='none';
                if (data.status == false) {
                    showError(data.message);
                    return;
                }
                else {
                    $(ob).html('Отправили запрос');
                    $(ob).attr('href','#');
                    $(ob).attr('onclick','');

                    $(ob).html('Отменить запрос <i class="fa fa-arrow-circle-right"></i>');
                    $(ob).attr('href','javascript:void(0)');
                    $(ob).attr('onclick','cancelResponsePacket(this,' + packet_id + ')');
                    closeModal();
                    showMessage(data.message);
                }
            }
        });
    }
}

function buyPacketFromBalance(ob,packet_id,user_packet_type){
    if(confirm('Действительно хотите купить?')) {
        document.getElementById('ajax-loader').style.display='block';
        $.ajax({
            url: '/admin/packet/user/balance',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                packet_id: packet_id,
                user_packet_type: user_packet_type
            },
            success: function (data) {
                document.getElementById('ajax-loader').style.display='none';
                if (data.status == false) {
                    showError(data.message);
                    return;
                }
                else {

                    $('.shop_buy_btn').remove('');

                    closeModal();
                    showMessage(data.message);
                }
            }
        });
    }
}

function acceptUserPacket(ob,packet_id){
    if(confirm('Действительно хотите принять запрос?')) {
        document.getElementById('ajax-loader').style.display='block';
        $.ajax({
            url: '/admin/packet/user/inactive',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                packet_id: packet_id
            },
            success: function (data) {
                document.getElementById('ajax-loader').style.display='none';
                if (data.status == false) {
                    showError(data.message);
                    return;
                }
                else {
                    $(ob).html('Принято');
                    $(ob).removeClass('btn-success');
                    $(ob).addClass('btn-info');
                    $(ob).attr('onclick','');
                    closeModal();
                    showMessage(data.message);
                }
            }
        });
    }
}

function deleteUserPacket(ob,packet_id){
    if(confirm('Действительно хотите удалить запрос?')) {
        document.getElementById('ajax-loader').style.display='block';
        $.ajax({
            url: '/admin/packet/user/inactive',
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                packet_id: packet_id
            },
            success: function (data) {
                document.getElementById('ajax-loader').style.display='none';
                if (data.status == false) {
                    showError(data.message);
                    return;
                }
                $(ob).closest('tr').remove();
            }
        });
    }
}

function opUl(t){
    var ultag = t.parentNode.getElementsByTagName('UL')[0].style;
    if(ultag.display != 'block'){
        ultag.display = 'block';
        t.innerHTML = '-';
    }
    else{
        t.innerHTML = '+';
        ultag.display = 'none';
    }
}

function copyLink() {
    window.prompt("Нажмите: Ctrl+C и enter", $('#url_link').val());
}

function getChildAjax(t,user_id,level){
    $.ajax({
        url: '/admin/structure/child/' + user_id + '/' + level,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.status == false) {
                showError(data.message);
                return;
            }
            else {
                $(t).closest('.parent').find('.child-list').html(data);
                var ultag = t.parentNode.getElementsByTagName('UL')[0].style;
                if(ultag.display != 'block'){
                    ultag.display = 'block';
                    t.innerHTML = '-';
                }
                else{
                    t.innerHTML = '+';
                    ultag.display = 'none';
                }
            }
        }
    });
}

function acceptUserRequest(ob,user_request_id){
    if(confirm('Действительно хотите принять запрос?')) {
        document.getElementById('ajax-loader').style.display='block';
        $.ajax({
            url: '/admin/request/inactive',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                user_request_id: user_request_id
            },
            success: function (data) {
                document.getElementById('ajax-loader').style.display='none';
                if (data.status == false) {
                    showError(data.message);
                    return;
                }
                else {
                    $(ob).html('Принято');
                    $(ob).removeClass('btn-success');
                    $(ob).addClass('btn-info');
                    $(ob).attr('onclick','');
                    showMessage(data.message);
                }
            }
        });
    }
}

function deleteUserRequest(ob,user_request_id){
    if(confirm('Действительно хотите удалить запрос?')) {
        document.getElementById('ajax-loader').style.display='block';
        $.ajax({
            url: '/admin/request/inactive',
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                user_request_id: user_request_id
            },
            success: function (data) {
                document.getElementById('ajax-loader').style.display='none';
                if (data.status == false) {
                    showError(data.message);
                    return;
                }
                $(ob).closest('tr').remove();
            }
        });
    }
}

function addResponseAddRequest(ob){
    if(confirm('Действительно хотите отправить запрос?')) {
        document.getElementById('ajax-loader').style.display='block';
        $.ajax({
            url: '/admin/request',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                money: $('#money').val(),
                comment: $('#comment').val()
            },
            success: function (data) {
                document.getElementById('ajax-loader').style.display='none';
                if (data.status == false) {
                    showError(data.message);
                    return;
                }
                else {
                    $('#comment').val('');
                    $('#money').val('');
                    showMessage(data.message);
                }
            }
        });
    }
}

function getCityListByCountry(ob) {
    $('#city_id').html('');
    $.get('/city?country_id=' + ob.value, function(data){
        var select = $('#city_id');
        $(select).html('<option value="">Выберите город</option>');
        $(data.data).each(function(){
            $(select).append('<option value="' + this.city_id + '">' + this.city_name +'</option>');
        });
    });
}

function getCityListByCountry2(ob) {
    $('#fact_city_id').html('');
    $.get('/city?country_id=' + ob.value, function(data){
        var select = $('#fact_city_id');
        $(select).html('<option value="">Выберите город</option>');
        $(data.data).each(function(){
            $(select).append('<option value="' + this.city_id + '">' + this.city_name +'</option>');
        });
    });
}

function changeMoney(percent) {
    money = $('#money').val();
    money_nalog = $('#money').val() * percent;
    $('#money_label').html(money_nalog + ' $');
}

function cancelResponsePacket(ob,packet_id){
    if(confirm('Действительно хотите отменить свой запрос?')) {
        document.getElementById('ajax-loader').style.display='block';
        $.ajax({
            url: '/admin/packet/user',
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                packet_id: packet_id
            },
            success: function (data) {
                document.getElementById('ajax-loader').style.display='none';
                if (data.status == false) {
                    showError(data.message);
                    return;
                }
                else {
                    $(ob).html('Купить пакет <i class="fa fa-arrow-circle-right"></i>');
                    $(ob).attr('href','javascript:void(0)');
                    $(ob).attr('onclick','showBuyModal(' + packet_id + ')');

                    showMessage(data.message);
                    location.reload();
                }
            }
        });
    }
}

function showBuyModal(ob,id) {
    $('#buy_btn').attr('onclick','buyPacketOnline("' + $(ob).closest('.packet-item-list').find('.packet_type').val() + '",' + id + ')');
    $('#send_request_btn').attr('onclick','addResponseAddPacket($(".buy_btn_' + id + '"),' + id + ',"' + $(ob).closest('.packet-item-list').find('.packet_type').val() + '")');
    $('#buy_packet_from_balance_btn').attr('onclick','buyPacketFromBalance($(".buy_btn_' + id + '"),' + id + ',"' + $(ob).closest('.packet-item-list').find('.packet_type').val() + '")');
    $('#buy_modal').fadeIn(0);
    $('#blur').fadeIn(0);
}

function redirectPaybox(user_packet_type,id) {
    if(confirm('Действительно хотите купить пакет онлайн?')) {
        $.ajax({
            type: 'get',
            url: "/admin/packet/paybox",
            data: {
                packet_id: id,
                user_packet_type: user_packet_type
            },
            success: function(data){
                if(data.status == false){
                    showError(data.message);
                }
                else window.location.href = "https://www.paybox.kz/payment.php?" + data.href;
            }
        });
    }
}

function showChildList(ob,user_id,main_user_id) {
    $.ajax({
        type: 'get',
        url: "/admin/binar/child",
        data: {
            user_id: user_id,
            main_user_id: main_user_id
        },
        success: function(data){
            if(data.status == false){
                showError(data.message);
            }
            $(ob).closest('.child-list').html(data);
        }
    });
}

function saveConfigStructure() {
    $.ajax({
        type: 'POST',
        url: "/admin/binar/config",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            is_left_config: $('input[name="is_left"]:checked').val()
        },
        success: function(data){
            if(data.status == false){
                showError(data.message);
            }
            else showMessage(data.message);
        }
    });
}

function showCallFriendModal(url,parent_id,is_left){
    var tmp   = document.createElement('INPUT'), // Создаём новый текстовой input
        focus = document.activeElement; // Получаем ссылку на элемент в фокусе (чтобы не терять фокус)

    tmp.value = url + '/register?id=' + parent_id + '&left=' + is_left; // Временному input вставляем текст для копирования

    document.body.appendChild(tmp); // Вставляем input в DOM
    tmp.select(); // Выделяем весь текст в input
    document.execCommand('copy'); // Магия! Копирует в буфер выделенный текст (см. команду выше)
    document.body.removeChild(tmp); // Удаляем временный input
    focus.focus(); // Возвращаем фокус туда, где был

    showMessage('Ссылка скопирована, теперь Вы можете отправить другу')
}

function getChildAjaxSecond(t,user_id,level){
    $.ajax({
        url: '/admin/structure/child/' + user_id + '/' + level,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.status == false) {
                showError(data.message);
                return;
            }
            else {
                $(t).closest('.parent').find('.child-list').html(data);
                var ultag = t.parentNode.getElementsByTagName('UL')[0].style;
                if(ultag.display != 'block'){
                    ultag.display = 'block';
                    t.innerHTML = '-';
                }
                else{
                    t.innerHTML = '+';
                    ultag.display = 'none';
                }
            }
        }
    });
}

function redirectPaybox(user_packet_type,id) {
    if(confirm('Действительно хотите купить пакет онлайн?')) {
        $.ajax({
            type: 'get',
            url: "/admin/packet/paybox",
            data: {
                packet_id: id,
                user_packet_type: user_packet_type
            },
            success: function(data){
                if(data.status == false){
                    showError(data.message);
                }
                else window.location.href = "https://www.paybox.kz/payment.php?" + data.href;
            }
        });
    }
}

function deleteServiceDocument(ob) {
    $(ob).closest('.i-docs').remove();
}

var service_document_g = null;
var image_id_g = null;
var is_service_g = 1;

function uploadServiceDocument(ob,image_id) {
    $('.ajax-loader').css('display','block');
    service_document_g = ob;
    image_id_g = image_id;
    is_service_g = 1;
    $("#document_upload_form").submit();
}

$("#document_upload_form").submit(function(event) {
    event.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url:'/image/upload/doc?image_id=' + image_id_g,
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
            $('.ajax-loader').css('display','none');
            if(data.success == 0){
                showError(data.error);
                return;
            }
            getDocumentList(data.file_name,data.format,image_id_g);
        }
    });
});

function getDocumentList(document_url,document_type,document_id){
    $.ajax({
        type: 'GET',
        url: "/admin/ajax/document",
        data:{
            document_url: document_url,
            document_type: document_type,
            image_id: image_id_g,
            document_id: document_id
        },
        success: function(data){
            $('#document_item_' + image_id_g).find('.input-box').prepend(data);
        }
    });
}

function saveUserDocument() {
    $('.ajax-loader').css('display','block');

    var request_document = [];
    $('.request-document').each(function(){
        request_document.push($(this).val());
    });

    var document_type = [];
    $('.document-type').each(function(){
        document_type.push($(this).val());
    });

    var document_id = [];
    $('.document-id').each(function(){
        document_id.push($(this).val());
    });

    $.ajax({
        type: 'POST',
        url: "/admin/ajax/document",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data :{
            user_id: $('#user_id').val(),
            is_individual: $('.is_individual:checked').val(),
            user_document: request_document,
            document_type: document_type,
            document_id: document_id
        },
        success: function(data){
            $('.ajax-loader').css('display','none');
            if(data.status == 0){
                showError(data.error);
                return;
            }
            else {
                $('#confirm_btn').fadeIn();
                showMessage(data.message);
            }
        }
    });
}

function sendToCheckDocument() {
    $.ajax({
        type: 'POST',
        url: "/admin/ajax/document/confirm",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data :{
            user_id: $('#user_id').val(),
            is_individual: $('.is_individual:checked').val()
        },
        success: function(data){
            $('.ajax-loader').css('display','none');
            if(data.status == 0){
                showError(data.error);
                return;
            }
            else {
                showMessage(data.message);
            }
        }
    });
}

function confirmUserDocument(is_valid_document) {
    $.ajax({
        type: 'POST',
        url: "/admin/ajax/document/confirm-by-admin",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data :{
            user_id: $('#user_id').val(),
            is_valid_document: is_valid_document
        },
        success: function(data){
            $('.ajax-loader').css('display','none');
            if(data.status == 0){
                showError(data.error);
                return;
            }
            else {
                showMessage(data.message);
                $('#confirm_btn').remove();
            }
        }
    });
}

function deleteUserDocumentRequest(ob,id){
    if(confirm('Действительно хотите удалить запрос?')) {
        document.getElementById('ajax-loader').style.display='block';
        $.ajax({
            url: '/admin/ajax/document/confirm',
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },
            success: function (data) {
                document.getElementById('ajax-loader').style.display='none';
                if (data.status == false) {
                    showError(data.message);
                    return;
                }
                $(ob).closest('tr').remove();
            }
        });
    }
}

function addBalance(user_packet_type,id) {
    if(confirm('Действительно хотите пополнить баланс?')) {
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/admin/balance/paybox",
            data: {
                balance: $('#balance').val()
            },
            success: function(data){
                if(data.status == false){
                    showError(data.error);
                }
                else window.location.href = "https://www.paybox.kz/payment.php?" + data.href;
            }
        });
    }
}


function sendMoneyToOtherAccount(ob){
    if(confirm('Действительно хотите отправить деньги?')) {
        document.getElementById('ajax-loader').style.display='block';
        $.ajax({
            url: '/admin/request/send-money',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                money: $('#money').val(),
                recipient_id: $('#recipient_id').val(),
                comment: $('#comment').val()
            },
            success: function (data) {
                document.getElementById('ajax-loader').style.display='none';
                if (data.status == false) {
                    showError(data.message);
                    return;
                }
                else {
                    $('#comment').val('');
                    $('#money').val('');
                    showMessage(data.message);
                }
            }
        });
    }
}

function buyPacketOnline(user_packet_type,packet_id) {
    if(confirm('Действительно хотите купить онлайн?')) {
        document.getElementById('ajax-loader').style.display='block';
        $.ajax({
            url: '/smartpay/create_order',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                packet_id: packet_id,
                user_packet_type: user_packet_type                
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


function show_more_detail(btn) {    
    let data = $(btn).data('id');
    console.log(data)
    let form = $('#order_form').find('form');
    $(form).find('#username').val(data.username)
    $(form).find('#contact').val(data.contact)
    $(form).find('#email').val(data.email)
    $(form).find('#address').val(data.address)    
    $(form).find('#payment_id').val(data.payment_id)    
    if (data.delivery_id == 1) {
        $(form).find('#delivery').val('Самовывоз')        
    }
    if (data.delivery_id == 2) {
        $(form).find('#delivery').val('Курьером')        
    }
    if (data.delivery_id == 3) {
        $(form).find('#delivery').val('По почтам')
    }

    let products = JSON.parse(data.products)    
    $(form).find('#product_list').empty()
    for (let i = 0; i < products.length; i++) {
        $(form).find('#product_list').append(
            `
            <tr>
                <th scope="row">${i+1}</th>
                <td>${products[i].product_name}</td>
                <td>${products[i].count}</td>                
            </tr>
            `
        )        
    }
}