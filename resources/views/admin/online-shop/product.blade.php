@extends('admin.layout.layout')

@section('breadcrump')

    <section class="content-header">
        <h1>
            Магазин
        </h1>

        <div class="alert alert-warning">
            <h4>* Активный Партнер - это Партнер совершающий покупку продукции не менее 24$ каждый месяц</h4>
            <h4>** Cash Back бонус получает со статуса AGENT и выше</h4>
        </div>
        
        <div style="text-align: left; font-weight: bold; color: #009551;">
            <h4>У вас имеется бонус за покупку пакета</h4>
            <h4 style="font-size: 20px;">Пакетный Бонус: {{ Auth::user()->product_balance * \App\Models\Currency::pvToKzt() }} KZT</h4>
        </div>
        <div style="text-align: right">
            <a style="font-size: 20px;text-decoration: underline;" href="/admin/basket">Посмотреть корзину <span id="basket_count" class="label label-primary pull-right" style=" background-color: rgb(253, 58, 53) ! important; font-size: 15px; border-radius: 50%">{{$row->basket_count}}</span></a>
        </div>

        <div style="display: flex; justify-content: space-evenly; text-align: center;">
            <div>
                <form action="/admin/online" method="GET">
                    <input type="hidden" name="is_client" value="1">
                    <h4>Для клиентов 10% скидка</h4>
                    <button> Я клиент </button>
                </form>
            </div>
            <div>
                <form action="/admin/online" method="GET">
                    <input type="hidden" name="is_partner" value="1">
                    <h4>Для партнеров 20% скидка</h4>
                    <button> Я партнер </button>
                </form>
            </div>
            @if (Auth::user()->product_balance > 0)
                <div>
                    <form action="/admin/online" method="GET">
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
            <h2 class="page-header">Список товаров</h2>
        </div>

        @include('admin.online-shop.product-list-loop')

    </div>

    <div class="text-center">
        {!! $row->products->links() !!}
    </div>

    <div class="modal-dialog" id="shop_modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModal()"><span aria-hidden="true">×</span></button>
                <h2 class="modal-title" id="modal_title"></h2>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" onclick="closeModal()">Закрыть</button>
            </div>
        </div><!-- /.modal-content -->
    </div>

@endsection


