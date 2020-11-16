@extends('admin.layout.layout')

@section('breadcrump')

    <section class="content-header">
        <h1>
            Корзина
        </h1>
        <div style="text-align: left; font-weight: bold; color: #009551;">
            <h4>У вас имеется бонус за покупку пакета</h4>
            <h4 style="font-size: 20px;">Пакет бонус: {{ Auth::user()->product_balance * \App\Models\Currency::pvToKzt() }} KZT</h4>
        </div>
        <div style="text-align: right">
            <a style="font-size: 20px;text-decoration: underline;" href="/admin/online">Перейти в магазин<span
                        id="basket_count" class="label label-primary pull-right"
                        style=" background-color: rgb(253, 58, 53) ! important; font-size: 15px; border-radius: 50%">{{$row->basket_count}}</span></a>
        </div>

        <div style="display: flex; justify-content: space-evenly; text-align: center;">
            <div>
                <form action="/admin/basket" method="GET">
                    <input type="hidden" name="is_client" value="1">
                    <h4>Для клиентов 10% скидка</h4>
                    <button> Я клиент </button>
                </form>
            </div>
            <div>
                <form action="/admin/basket" method="GET">
                    <input type="hidden" name="is_partner" value="1">
                    <h4>Для партнеров 20% скидка</h4>
                    <button> Я партнер </button>
                </form>
            </div>
            @if (Auth::user()->product_balance > 0)
                <div>
                    <form action="/admin/basket" method="GET">
                        <input type="hidden" name="is_packet" value="1">
                        <h4>Для пакетных бонусов 33% скидка</h4>
                        <button> У меня есть бонус </button>
                    </form>
                </div>
            @endif                    
        </div>
    </section>

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <h2 class="page-header">Корзина</h2>
        </div>
        <div class="col-xs-12">
            <div class="box">
                @include('admin.online-shop.basket-list-loop')
            </div>
        </div>
    </div>

    <div class="modal-dialog" id="shop_modal" style="display: none">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModal()"><span aria-hidden="true">×</span></button>
                <h2 class="modal-title" id="modal_title">Подтвердить заказ</h2>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="address">Адрес</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="г.Алматы ул.Абая 187а кв 94">
                </div>
                <div class="form-group">
                    <label for="delivery">Доставка</label>
                    <select class="form-control" name="delivery" id="delivery">
                        <option value="1" selected>Самовывоз</option>
                        <option value="2">Курьером</option>
                        <option value="3">По почте</option>
                    </select>                                
                </div>    
                @if ($row->is_packet)
                    <input type="hidden" name="type" id="discount_type" value="is_packet">
                @elseif($row->is_partner)
                    <input type="hidden" name="type" id="discount_type" value="is_partner">
                @else
                    <input type="hidden" name="type" id="discount_type" value="is_client">
                @endif                 
                <p><span>Общая сумма: </span><span id="modal_desc"></span></p>
            </div>
            <div class="modal-footer">
                @if ($row->is_packet)
                    <button onclick="confirmBasket()"
                        id="confirmBasketBtn"
                        style="margin-left:0px; background-color: #6cba5b; width: 100%; margin-bottom: 20px"
                        type="button" class="btn btn-default pull-left">Снять с Пакетного бонуса
                    </button>
                @else
                    <button onclick="confirmBasket()"
                        id="confirmBasketBtn"
                        style="margin-left:0px; background-color: #6cba5b; width: 100%; margin-bottom: 20px"
                        type="button" class="btn btn-default pull-left">Снять с баланса
                    </button>
                    <button onclick="buyProductOnline()"
                            style="margin-left:0px; background-color: #6cba5b; width: 100%; margin-bottom: 20px"
                            type="button" class="btn btn-default pull-left">Купить онлайн
                    </button>
                    @if ($pay_from_cash_balanse)
                        <button onclick="setSuperBalance()"
                            id="setSuperBalanceBtn"
                            style="margin-left:0px; background-color: #6cba5b; width: 100%; margin-bottom: 20px"
                            type="button" class="btn btn-default pull-left">Снять с super баланса
                        </button>
                    @endif                    
                @endif                
            </div>
        </div>
    </div>

@endsection


