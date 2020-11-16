@extends('admin.layout.layout')
@section('breadcrump')
    <section class="content-header">
        <h1>
            Магазин
        </h1>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <h2 class="page-header">Новые пакеты (товары) </h2>
        </div>
        {!! view('admin.shop.packet-list-loop',[
                    'row' => $row,
                    'max_packet_user_number' => $max_packet_user_number,
                    'packet_type' => 'item',
                    ]) !!}

    </div>
    <div class="modal-dialog" id="shop_modal" style="display: none">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModal()"><span aria-hidden="true">×</span></button>
                <h2 class="modal-title" id="modal_title"></h2>
            </div>
            <div class="modal-body">
                <p id="modal_desc"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" onclick="closeModal()">Закрыть</button>
            </div>
        </div><!-- /.modal-content -->
    </div>

    <div class="modal-dialog" id="buy_modal" style="max-width: 350px; display: none">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModal()"><span aria-hidden="true">×</span></button>
                <h2 class="modal-title">Купить пакет</h2>
            </div>

            <div class="modal-footer">
                <button style="width: 100%; margin-bottom: 20px" type="button" onclick="closeModal()"
                        class="btn btn-default pull-left">Закрыть
                </button>               
                <form action="{{ route('smartpay_create_order') }}" method="post" id="buyPacketForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="packet_id">
                    <button id="buy_btn"
                        style="margin-left:0px; background-color: #6cba5b; width: 100%; margin-bottom: 20px"
                        type="button" class="btn btn-default pull-left">Купить онлайн
                    </button>
                </form>
                <button style="margin-left:0px; background-color: #38b9ea; width: 100%; margin-bottom: 20px"
                        type="button" id="send_request_btn" class="btn btn-default pull-left">Отправить запрос
                </button>
                <button style="margin-left:0px; background-color: #38b9ea; width: 100%; margin-bottom: 20px"
                        type="button" id="buy_packet_from_balance_btn" class="btn btn-default pull-left">Снять с баланса
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div>


@endsection


