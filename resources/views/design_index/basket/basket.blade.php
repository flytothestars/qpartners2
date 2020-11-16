<?php

/** @var \App\Models\UserBasket $basketItems */
?>

<?php
$dollarCourse = (\App\Models\Currency::where(['currency_id' => 1])->first())->money;
$totalPrice = 0;
$basketIds = [];
?>
@extends('design_index.layout.layout')
@section('meta-tags')

    <title>Qpartners Shop</title>
    <meta name="description"
          content="«Qpartners» - это уникальный медиа проект с широким набором возожностей для взаймодествия с участниками виртуального рынка"/>
    <meta name="keywords" content="Qpartners"/>

@endsection


@section('content')
    <main id="mt-main">
        <section class="mt-contact-banner mt-banner-22 wow fadeInUp" data-wow-delay="0.4s"
                 style="background-image: url(http://placehold.it/1920x325);">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="text-center">SHOPPING CART</h1>
                        <!-- Breadcrumbs of the Page -->
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="index.html">Home <i class="fa fa-angle-right"></i></a></li>
                                <li>Shopping Cart</li>
                            </ul>
                        </nav>
                        <!-- Breadcrumbs of the Page end -->
                    </div>
                </div>
            </div>
        </section>
        <div class="mt-product-table wow fadeInUp" id="product-section" data-wow-delay="0.4s">
            <div class="container">
                <div class="row border">
                    <div class="col-xs-12 col-sm-4">
                        <strong class="title">Продукт</strong>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="title">Цена</strong>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="title">Кол-во</strong>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="title">Балл</strong>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="title">Итог</strong>
                    </div>
                </div>
                <?php foreach ($basketItems as $item): ?>
                <?php $basketItem = \App\Models\Product::where(['product_id' => $item->product_id])->first(); ?>
                <?php if(isset($basketItem)): ?>
                <?php array_push($basketIds, $basketItem->product_id) ?>
                <?php $totalPrice += $basketItem->product_price ?>
                <div class="row border">
                    <div class="col-xs-12 col-sm-2">
                        <div class="img-holder">
                            <div style="
                                    background-image: url('<?= $basketItem->product_image ?>');
                                    background-repeat: no-repeat;
                                    background-position: center;
                                    background-size: cover;
                                    width: 110px;
                                    height: 110px;
                                    ">

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="product-name"><?=  $basketItem->product_name; ?></strong>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="price">
                            <i class="fa fa-dollar"></i>{{$basketItem->product_price}}
                            &nbsp; &#8376; {{$basketItem->product_price * $dollarCourse}}
                        </strong>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <form action="#" class="qyt-form">
                            <fieldset>
                                <input type="number"
                                       step="1"
                                       value="1"
                                       style="width: 50%;"
                                       class="form-control"
                                       onchange="changeNumber(this, {{$basketItem->product_price}})"
                                       data-id="{{$basketItem->product_id}}"
                                >
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="price">{{$basketItem->ball}}</strong>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="price">
                            <i
                                    class="fa fa-dollar"
                                    id="product_price-{{$basketItem->product_id}}">
                                {{$basketItem->product_price}}
                            </i>
                            &nbsp; &#8376; <span
                                    id="product_price_kzt-{{$basketItem->product_id}}">{{$basketItem->product_price * $dollarCourse}} </span>
                        </strong>
                        <a style="cursor: pointer;" onclick="deleteItemFromBasket(this)"
                            data-action="/admin/online/{{ $basketItem->product_id }}"
                           data-method="delete"
                           data-item-id="{{$basketItem->product_id}}"
                           data-user-id="{{Auth::user()->user_id}}" class="event_button">
                            <i class="fa fa-close"></i></a>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <section class="mt-detail-sec style1 wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <h2>Итог</h2>
                        <ul class="list-unstyled block cart">
                            <li style="border-bottom: none;">
                                <div class="txt-holder">
                                    <strong class="title sub-title pull-left">Итоговая сумма:</strong>
                                    <div class="txt pull-right" id="total-price-div">
                                        <span><i class="fa fa-dollar"></i>
                                            <span id="total_price">
                                                {{$totalPrice}}
                                            </span>
                                             &nbsp; &#8376;
                                            <span id="total_price_kzt">
                                                {{$totalPrice * $dollarCourse}}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <a href="#" class="process-btn">Подтвердить заказ <i class="fa fa-check"></i></a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('js')
    <script>
        function deleteItemFromBasket(tag_object) {
            var action = $(tag_object).data('action');
            var method = $(tag_object).data('method');
            var item_id = $(tag_object).data('item-id');
            var user_id = $(tag_object).data('user-id');
            ajax(action, method, item_id, user_id);
            $("#basket-box").load(location.href + " #basket-box");
        }

        function changeNumber(tag_object, price) {
            var quantity = $(tag_object).val();
            var sum = quantity * price;
            var refreshedTotalPrice = 0;
            var basketIds = <?= json_encode($basketIds)?>;
            var coursePrice = <?= json_encode($dollarCourse) ?>;
            $("#product_price-" + $(tag_object).data('id')).text(sum);
            $("#product_price_kzt-" + $(tag_object).data('id')).text(sum * coursePrice);
            for (var i = 0; i < basketIds.length; i++) {
                var value = parseFloat($("#product_price-" + basketIds[i]).text())
                if (value) {
                    refreshedTotalPrice += value;
                }
            }
            $('#total_price').text(refreshedTotalPrice);
            $('#total_price_kzt').text(refreshedTotalPrice * coursePrice);
        }
    </script>
@endsection

