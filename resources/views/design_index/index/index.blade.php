<?php

use Illuminate\Support\Facades\Session;

?>
@extends('design_index.layout.layout')

@section('meta-tags')

    <title>Qpartners</title>
    <meta name="description"
          content="«Qpartners» - это уникальный медиа проект с широким набором возожностей для взаймодествия с участниками виртуального рынка"/>
    <meta name="keywords" content="Qpartners"/>
    <link rel="stylesheet" type="text/css" href="/new_design/css/link_style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

@endsection

@section('content')

    <main id="mt-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="banner-frame toppadding-zero">
                        <div class="banner-5 white wow fadeInLeft" data-wow-delay="0.4s">
                            <div style="max-width: 100%; height: 590px; background-image: url('/new_design/images/main_page_images/car_2.jpg'); background-size: cover; background-position: center;"></div>
                            <div class="holder" style="">
                                <strong class="title" style="position: absolute; left: 26px; top: 18px; color: #000;
                                    display: inline-block; vertical-align: middle; text-transform: uppercase;
                                    background: white; font-weight: 800; font-size: 98%;
                                    padding: 5px 10px; letter-spacing: 1px;">Социальная программа</strong>
                                <div class="texts" style="background-color:transparent; padding: 2rem 4rem -5rem 4rem; max-width: unset;">                                    
                                    {{-- <h3 style="font-weight: bold;word-break:keep-all;"><span
                                                class="span-1">Дарим новый huyndai accent activ</span> <br>
                                                <span class="span-1">за 6 190 000 KZT</span>
                                    </h3> --}}
                                    <p class="link_fonts">
                                        <span class="p-span-1">Дарим новый Huyndai Accent <br> стоимостью 6 190 000 KZT </span> <br>
                                        <span class="p-span-2">
                                            Выполни условия за 90 дней <br> и забирай свой Huyndai бесплатно!<br>                                            
                                        </span>
                                    </p>
                                    <a href="product-detail.html" class="link_style link_fonts">
                                        Забрать
                                        <!-- <i class="fa fa-angle-right"
                                           style="color: white;background-color: red;"></i> -->
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="banner-6 white wow fadeInRight" data-wow-delay="0.4s">
                            <div style="max-width: 100%; height: 590px; background-image: url('/new_design/images/main_page_images/iphone_2.jpg'); background-size: cover; background-position: center;background-repeat: no-repeat;"></div>
                            <div class="holder" style="background-color: rgba(0,0,0,0.1);">
                                <div style=" width: 100%; padding: 5px; position: relative;">
                                    <strong class="sub-title text-uppercase text-center"
                                            style="font-size: 15px; font-weight: 700; background-color: #000; color: #fff;">Социальная программа</strong>
                                    {{-- <h3 style="padding-left:2px;background-color:rgba(0,0,0,0.2); line-height: 3rem;">
                                        <span style="font-size:105%;">Зарядитесь</span> <br> <span
                                                class="text-uppercase"
                                                style="font-size: 100%;word-break: keep-all;">энергией природы</span>
                                    </h3>                                     --}}
                                </div>
                                <div style="position: absolute; bottom: 60px; left: 31px; right: 31px;">
                                    <p style="margin-top: 5rem;" class="link_fonts">
                                        <span class="p-span-3">APPLE IPHONE XI <br> в ПОДАРОК! </span> <br>
                                        <span class="p-span-4">
                                            Выполни условия за 30 дней <br>
                                            и IPHONE XI (389 890 KZT) твой!
                                        </span>
                                    </p>
                                </div>
                                <a href="product-detail.html" class="btn-shop link_style">
                                    <span style="color: #2c2c2c; !important;">Участвовать</span>
                                    <!-- <i class="fa fa-angle-right" style="color: white;background-color: #93d2ff;"></i> -->
                                </a>
                            </div>
                        </div><!-- banner 5 white end here -->
                        <!-- banner box two start here -->
                        <div class="banner-box two">
                            <!-- banner 7 right start here -->
                            <div class="banner-7 right wow fadeInUp" data-wow-delay="0.4s">
                                <div style="background-image: url('/new_design/images/main_page_images/macbook_2.jpg'); background-position: center; background-size: cover; height: 285px; max-width: 100%; "></div>
                                <div class="holder">
                                    <div class="text-center"
                                         style="width: 100%; padding: 2rem 1rem;">
                                        <h2 style="background: #24899b"><strong style="color: #fff; font-weight: bold;">Социальная программа</strong></h2>
                                        {{-- <h3 class="text-left" style="margin-top:10px;float: left;">
                                            <strong style="color: black;font-weight: 600;">Дышите
                                                <br> <span class="strong-span-1">ПОЛНОЙ ГРУДЬЮ</span></strong></h3> --}}                                       
                                    </div>
                                    <p style="float: left;color:black; position: absolute; bottom: 30px;" class="text-left link_fonts">
                                        <span class="p-span-5 text-left">ХОЧЕШЬ MACKBOOK AIR (554 990 KZT) БЕСПЛАТНО?</span><br>
                                        <span class="p-span-6">
                                            Выполни условия за 60 дней <br>
                                            и забирай свой MACBOOK AIR<br>
                                        </span>
                                    </p>
                                    <div class="price-tag">
                                        <a class="link_style link_fonts" href="product-detail.html">ХОЧУ</a>
                                    </div>
                                </div>
                            </div><!-- banner 7 right end here -->
                            <!-- banner 8 start here -->
                            <div class="banner-8 wow fadeInDown" data-wow-delay="0.4s">
                                <div style="background-image: url('/new_design/images/frister.jpg'); background-position: center; background-size: cover; height: 285px; max-width: 100%; "></div>
                                <div class="holder text-left" style="background-color: rgba(0,0,0,0.2);">
                                    <div style="width: 100%; padding: 0 1rem;">
                                        <h2 style="background: #69ab00;" class="text-center"><strong style="color: white; font-weight: bold;">Социальная программа</strong></h2>
                                        {{-- <h3 style="margin-bottom:20px !important;"><strong>Укрепите
                                                <br> ИММУНИТЕТ</strong></h3> --}}                                        
                                    </div>
                                    <div style="position: absolute; padding: 0 1rem; bottom: 20px;">
                                        <p style="float: left;font-family: 'Roboto Slab', serif;color:black; font-size: 15px; margin: 0px 0px 15px;" class="text-left">
                                            {{-- <span class="p-span-5 text-left">Super Elixir Bronchi</span><br> --}}
                                            <span class="p-span-6">
                                                Выполни условия и получи <br>
                                                денежную премию 90 000 KZT<br>                                                
                                            </span>
                                        </p>

                                        <div class="price-tag text-left" style="padding-top: 0; margin-left: 0.8rem;">
                                            <a class="btn-shop link_style" href="product-detail.html">
                                                <span>ПОЛУЧИТЬ</span>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- banner 8 start here -->
                        </div>
                    </div>
                    <div class="banner-frame mt-paddingsmzero">
                        <!-- banner box third start here -->
                        <div class="banner-box third">
                            <!-- banner 12 right white start here -->
                            <div class="banner-12 right white wow fadeInUp" data-wow-delay="0.4s">
                                <img src="/new_design/images/main_page_images/super_elixir_for_man.png"
                                     alt="image description"
                                     style="height: 277px;  width: 420px;">
                                <div class="holder this-banner" style="">
                                    <h2 class="text-uppercase" style="float:left;padding-bottom: 1rem;"><span
                                                class="text-uppercase">ДЛЯ МУЖЧИН</span></h2>

                                    <p style="float: left;color:black;padding: 2px;" class="text-left link_fonts ">
                                        <span class="p-span-5 text-left">Super Elixir For Man</span><br>
                                        <span class="p-span-6">
                                                обладает иммуно- <br>
                                                стимулирующим, <br>
                                                действием, активный <br>
                                                гемостимулятор.
                                            </span> <br>
                                        <span class="p-span-6" style="margin-top: 10px;">
                                            Эффективен при <br>
                                            везекулите.
                                        </span>
                                    </p>

                                    <a class="btn-shop link_style" href="product-detail.html">
                                        <span>купить сейчас</span>
                                    </a>
                                </div>
                            </div><!-- banner 12 right white end here -->
                            <!-- banner 13 right start here -->
                            <div class="banner-13 right wow fadeInDown" data-wow-delay="0.4s">
                                <img src="/new_design/images/main_page_images/super_elixir_for_woman.png"
                                     alt="image description"
                                     style="height: 277px;  width: 420px;">
                                <div class="holder this-banner" style="">
                                    <h2 class="text-uppercase" style="float:left;padding-bottom: 1rem;"><span
                                                class="text-uppercase">ДЛЯ ЖЕНЩИН</span></h2>

                                    <p style="float: right;color:black;padding: 2px;" class="text-left link_fonts">
                                        <span class="p-span-5 text-left">Super Elixir <br> For Woman</span><br>
                                        <span class="p-span-6">
                                                обладает <br>
                                                общеукрепляющим <br>
                                                действием, снижает <br>
                                                слабость и упадок сил.
                                            </span> <br>
                                        <span class="p-span-6" style="margin-top: 10px;">
                                           Продлевает детородный <br> возраст.
                                        </span>
                                    </p>

                                    <a class="btn-shop link_fonts" href="product-detail.html">
                                        <span>купить сейчас</span>
                                    </a>
                                </div>
                            </div><!-- banner 13 right end here -->
                        </div><!-- banner box third end here -->
                        <!-- slider 7 start here -->
                        <div class="slider-7 wow fadeInRight" data-wow-delay="0.4s">
                            <!-- slider start here -->
                            <div class="slider banner-slider">
                                <!-- holder start here -->
                                <div class="s-holder link_">
                                    <img src="/new_design/images/main_page_images/1.png"
                                         alt="image description">
                                    {{-- <div class="s-box">
                                        <strong class="s-title text-uppercase">Супер акция 5+2</strong>
                                        <span class="heading"
                                              style="font-weight: bold;font-size: 40px;">Super Elixir for Man</span>
                                        <div class="s-txt">
                                            <p class="s-text-p">улучшает мужское здоровье. <br>
                                                Является эффективным иммуностимулятором, <br>
                                                активный гемостимулятор.
                                            </p>
                                            <div class="s-text-p-2">
                                                1. Super Elixir For Man <br>
                                                2. Super Elixir Nephro <br>
                                                3. Super Elixir For Bronchi <br>
                                                4. Super Cream Spasm <br>
                                                5. Super Detox Universal <br>
                                            </div>
                                            <div class="s-text-p-3-div">
                                                <h4 class="s-text-p-3-title text-uppercase">
                                                    В ПОДАРОК
                                                </h4>
                                                <div class="s-text-p-3">
                                                    1. Super Elixir Anti-Stress <br>
                                                    2. Super Elixir Immuno
                                                </div>
                                            </div>

                                        </div>
                                        <a class="s-text-p-3-button">
                                            ПОДРОБНЕЕ
                                        </a>
                                    </div> --}}
                                </div><!-- holder end here -->
                                <!-- holder start here -->
                                <div class="s-holder s-holder-2">
                                    <img src="/new_design/images/main_page_images/2.png"
                                         alt="image description">
                                    {{-- <div class="s-box">
                                        <strong class="s-title text-uppercase">Супер акция 5+2</strong>
                                        <span class="heading"
                                              style="font-weight: bold;font-size: 40px;color: #ac2709;">Super Elixir Hepato</span>
                                        <div class="s-txt" style="color: white;">
                                            <p class="s-text-p">обладает противовирусным, желчегонным <br>
                                                и рассасывающим действием. <br>
                                                Восстанавливает работу печени.
                                            </p>
                                            <div class="s-text-p-2">
                                                1. Super Elixir Hepato <br>
                                                2. Super Elixir Gastro <br>
                                                3. Super Elixir Bronchi <br>
                                                4. Super Cream Spasm <br>
                                                5. Super Detox Universal <br>
                                            </div>
                                            <div class="s-text-p-3-div">
                                                <h4 class="s-text-p-3-title text-uppercase">
                                                    В ПОДАРОК
                                                </h4>
                                                <div class="s-text-p-3">
                                                    1. Super Elixir Anti-Stress <br>
                                                    2. Super Elixir Immuno
                                                </div>
                                            </div>

                                        </div>
                                        <a class="s-text-p-3-button s-holder-2-button">
                                            ПОДРОБНЕЕ
                                        </a>
                                    </div> --}}
                                </div>
                                <div class="s-holder s-holder-3">
                                    <img src="/new_design/images/main_page_images/3.png"
                                         alt="image description">
                                    {{-- <div class="s-box">
                                        <strong style="color: white;" class="s-title text-uppercase">Супер акция
                                            5+2</strong>
                                        <span class="heading"
                                              style="font-weight: bold;font-size: 40px;color: black;">Super Elixir For Woman</span>
                                        <div class="s-txt" style="color: black;float: none;">
                                            <p class="s-text-p"
                                               style="float: left; background-color: rgba(255,255,255,0.5); padding: 5px;">
                                                поддерживает и восстанавливает<br>
                                                женское здоровье. Обладает <br>
                                                общеукрепляющим <br>
                                                действием.
                                            </p>
                                            <div style="float: right;margin-right: 30px;">
                                                <div class="s-text-p-2">
                                                    1. Super Elixir for Woman <br>
                                                    2. Super Elixir Gastro <br>
                                                    3. Super Elixir Bronchi <br>
                                                    4. Super Cream Spasm <br>
                                                    5. Super Detox Universal <br>
                                                </div>
                                                <div class="s-text-p-3-div">
                                                    <h4 class="s-text-p-3-title text-uppercase">
                                                        В ПОДАРОК
                                                    </h4>
                                                    <div class="s-text-p-3">
                                                        1. Super Elixir Anti-Stress <br>
                                                        2. Super Elixir Immuno
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <a class="s-text-p-3-button s-holder-2-button" style="    margin-top: 360px;
    margin-right: -230px;">
                                            ПОДРОБНЕЕ
                                        </a>
                                    </div> --}}
                                </div>
                                <div class="s-holder s-holder-4">
                                    <img src="/new_design/images/main_page_images/4.png"
                                         alt="image description">
                                    {{-- <div class="s-box">
                                        <strong style="color: white; background-color: #77a100;" class="s-title text-uppercase">Супер акция
                                            5+2</strong>
                                        <span class="heading"
                                              style="font-weight: bold;font-size: 40px;color: #77a100;">Super Elixir For Woman</span>
                                        <div class="s-txt" style="color: black;float: none;">
                                            <p class="s-text-p"
                                               style="background-color:rgba(255,255,255,0.5);float: left; padding: 5px;">
                                                очищает организм от паразитов, <br>
                                                улучшает работу желудочно-кишечного <br>
                                                тракта.
                                            </p>
                                            <div style="float: right;margin-right: 30px;">
                                                <div class="s-text-p-2">
                                                    1. Super Elixir Clean <br>
                                                    2. Super Elixir For Man <br>
                                                    3. Super Elixir For Woman <br>
                                                    4. Super Cream Spasm <br>
                                                    5. Super Detox Universal <br>
                                                </div>
                                                <div class="s-text-p-3-div">
                                                    <h4 class="s-text-p-3-title text-uppercase">
                                                        В ПОДАРОК
                                                    </h4>
                                                    <div class="s-text-p-3">
                                                        1. Super Elixir Anti-Stress <br>
                                                        2. Super Elixir Immuno
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <a class="s-text-p-3-button s-holder-2-button" style="    margin-top: 360px;
    margin-right: -230px;background-color: #77a100 !important;">
                                            ПОДРОБНЕЕ
                                        </a>
                                    </div> --}}
                                </div>
                            </div>
                        </div><!-- slider 7 end here -->
                    </div>
                    <div class="mt-producttabs style2 wow fadeInUp" data-wow-delay="0.4s">
                        <!-- producttabs start here -->
                        <ul class="producttabs">
                            <li><a href="#tab1" class="active">Элексиры</a></li>
                            <li><a href="#tab2">Спреи</a></li>
                            <li><a href="#tab3">Гели</a></li>
                            <li><a href="#tab4">Крема</a></li>
                        </ul>
                        <!-- producttabs end here -->
                        <div class="tab-content">
                            <div id="tab1">
                                <div class="tabs-sliderlg">
                                    @foreach($elixirs as $product)
                                        <div class="slide">
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">
                                                            <a href="{{ route('product.detail',$product->product_id, ['id' => $product->product_id]) }}">
                                                                <div class="product_image" 
                                                                    style="background-image: url('{{$product->product_image}}');">
                                                                </div>
                                                            </a>
                                                            <ul class="mt-stars">
                                                                @for($i = 0; $i<5;$i++)
                                                                    @if($i < \App\Models\Review::ratingCalculator($product->product_id, \App\Models\Review::PRODUCT_REVIEW))
                                                                        <li><i class="fa fa-star"></i></li>
                                                                    @else
                                                                        <li><i class="fa fa-star-o"></i></li>
                                                                    @endif
                                                                @endfor

                                                            </ul>
                                                            <ul class="links">
                                                                <li>
                                                                    <a style="cursor: pointer;"
                                                                       data-item-id="{{$product->product_id}}"
                                                                       data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                                       data-method="add"
                                                                       data-route="{{route('basket.isAjax')}}"
                                                                       onclick="addItemToBasket(this)"
                                                                    ><i class="icon-handbag"></i><span>Добавить в корзину</span></a>
                                                                </li>
                                                                <li><a style="cursor: pointer;"
                                                                       data-item-id="{{$product->product_id}}"
                                                                       data-method="add"
                                                                       data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                                       data-session-id="{{ Session::getId()}}"
                                                                       data-route="{{route('favorite.isAjax')}}"
                                                                       onclick="addItemToFavorites(this)"
                                                                    ><i
                                                                                class="icomoon icon-heart-empty"></i></a>
                                                                </li>
                                                                <li><a href="#"><i
                                                                                class="icomoon icon-exchange"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="txt">
                                                    <strong class="title"><a
                                                                href="{{ route('product.detail',$product->product_id, ['id' => $product->product_id]) }}">{{$product->product_name_ru}}</a></strong>
                                                    <p>{{$product->product_desc_ru}}</p>
                                                    <span class="price"><i
                                                                class="fa fa-dollar"></i> <span>{{$product->product_price}}
                                                               ({{$product->product_price * (\App\Models\Currency::where(['currency_id' => 1 ])->first())->money}}   &#8376;) </span></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="tab2">
                                <div class="tabs-sliderlg">
                                    @foreach($sprays as $product)
                                        <div class="slide">
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">
                                                            <a href="{{ route('product.detail',$product->product_id, ['id' => $product->product_id]) }}">
                                                                <div class="product_image" 
                                                                    style="background-image: url('{{$product->product_image}}');">

                                                                </div>
                                                            </a>
                                                            <ul class="mt-stars">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                            <ul class="links">
                                                                <li>
                                                                    <a style="cursor: pointer;"
                                                                       data-item-id="{{$product->product_id}}"
                                                                       data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                                       data-method="add"
                                                                       data-route="{{route('basket.isAjax')}}"
                                                                       onclick="addItemToBasket(this)"
                                                                    ><i class="icon-handbag"></i><span>Добавить в карзину</span></a>
                                                                </li>
                                                                <li><a style="cursor: pointer;"
                                                                       data-item-id="{{$product->product_id}}"
                                                                       data-method="add"
                                                                       data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                                       data-session-id="{{ Session::getId()}}"
                                                                       data-route="{{route('favorite.isAjax')}}"
                                                                       onclick="addItemToFavorites(this)"
                                                                    ><i
                                                                                class="icomoon icon-heart-empty"></i></a>
                                                                </li>
                                                                <li><a href="#"><i
                                                                                class="icomoon icon-exchange"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="txt">
                                                    <strong class="title"><a
                                                                href="{{ route('product.detail',$product->product_id, ['id' => $product->product_id]) }}">{{$product->product_name_ru}}</a></strong>
                                                    <p>{{$product->product_desc_ru}}</p>
                                                    <span class="price"><i
                                                                class="fa fa-dollar"></i> <span>{{$product->product_price}}
                                                               ({{$product->product_price * (\App\Models\Currency::where(['currency_id' => 1 ])->first())->money}}   &#8376;) </span></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="tab3">
                                <div class="tabs-sliderlg">
                                    @foreach($gels as $product)
                                        <div class="slide">
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">
                                                            <a href="{{ route('product.detail',$product->product_id, ['id' => $product->product_id]) }}">
                                                                <div class="product_image"
                                                                    style="background-image: url('{{$product->product_image}}');">
                                                                </div>
                                                            </a>
                                                            <ul class="mt-stars">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                            <ul class="links">
                                                                <li>
                                                                    <a style="cursor: pointer;"
                                                                       data-item-id="{{$product->product_id}}"
                                                                       data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                                       data-method="add"
                                                                       data-route="{{route('basket.isAjax')}}"
                                                                       onclick="addItemToBasket(this)"
                                                                    ><i class="icon-handbag"></i><span>Добавить в карзину</span></a>
                                                                </li>
                                                                <li><a style="cursor: pointer;"
                                                                       data-item-id="{{$product->product_id}}"
                                                                       data-method="add"
                                                                       data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                                       data-session-id="{{ Session::getId()}}"
                                                                       data-route="{{route('favorite.isAjax')}}"
                                                                       onclick="addItemToFavorites(this)"><i
                                                                                class="icomoon icon-heart-empty"></i></a>
                                                                </li>
                                                                <li><a href="#"><i
                                                                                class="icomoon icon-exchange"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="txt">
                                                    <strong class="title"><a
                                                                href="{{ route('product.detail',$product->product_id, ['id' => $product->product_id]) }}">{{$product->product_name_ru}}</a></strong>
                                                    <p>{{$product->product_desc_ru}}</p>
                                                    <span class="price"><i
                                                                class="fa fa-dollar"></i> <span>{{$product->product_price}}
                                                               ({{$product->product_price * (\App\Models\Currency::where(['currency_id' => 1 ])->first())->money}}   &#8376;) </span></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="tab4">
                                <div class="tabs-sliderlg">
                                    @foreach($creams as $product)
                                        <div class="slide">
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">
                                                            <a href="{{ route('product.detail',$product->product_id, ['id' => $product->product_id]) }}">
                                                                <div class="product_image" 
                                                                    style="background-image: url('{{$product->product_image}}');">
                                                                </div>
                                                            </a>
                                                            <ul class="mt-stars">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                            <ul class="links">
                                                                <li>
                                                                    <a style="cursor: pointer;"
                                                                       data-item-id="{{$product->product_id}}"
                                                                       data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                                       data-method="add"
                                                                       data-route="{{route('basket.isAjax')}}"
                                                                       onclick="addItemToBasket(this)"
                                                                    ><i class="icon-handbag"></i><span>Добавить в карзину</span></a>
                                                                </li>
                                                                <li><a style="cursor: pointer;"
                                                                       data-item-id="{{$product->product_id}}"
                                                                       data-method="add"
                                                                       data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                                       data-session-id="{{ Session::getId()}}"
                                                                       data-route="{{route('favorite.isAjax')}}"
                                                                       onclick="addItemToFavorites(this)"><i
                                                                                class="icomoon icon-heart-empty"></i></a>
                                                                </li>
                                                                <li><a href="#"><i
                                                                                class="icomoon icon-exchange"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="txt">
                                                    <strong class="title"><a
                                                                href="{{ route('product.detail',$product->product_id, ['id' => $product->product_id]) }}">{{$product->product_name_ru}}</a></strong>
                                                    <p>{{$product->product_desc_ru}}</p>
                                                    <span class="price"><i
                                                                class="fa fa-dollar"></i> <span>{{$product->product_price}}
                                                               ({{$product->product_price * (\App\Models\Currency::where(['currency_id' => 1 ])->first())->money}}   &#8376;) </span></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-producttabs style3 wow fadeInUp" data-wow-delay="0.4s">
                        <h2 class="heading">Популярные</h2>
                        <div class="tabs-slider">
                            @foreach($popularProducts as $product)
                                <div class="slide">
                                    <div class="mt-product1">
                                        <div class="box">
                                            <div class="b1">
                                                <div class="b2">
                                                    <div class="product_new_image" style="background-image: url('{{$product->product_image}}')">
                                                    </div>
                                                    <span class="caption">
                                                        @if($product->is_new)
                                                            <span class="new">new</span>
                                                        @endif
														</span>
                                                    <ul class="mt-stars">
                                                        @for($i = 0; $i<5;$i++)
                                                            @if($i < \App\Models\Review::ratingCalculator($product->product_id, \App\Models\Review::PRODUCT_REVIEW))
                                                                <li><i class="fa fa-star"></i></li>
                                                            @else
                                                                <li><i class="fa fa-star-o"></i></li>
                                                            @endif
                                                        @endfor
                                                    </ul>
                                                    <ul class="links">
                                                        <li>
                                                            <a style="cursor: pointer;"
                                                               data-item-id="{{$product->product_id}}"
                                                               data-method="add"
                                                               data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                               data-route="{{route('basket.isAjax')}}"
                                                               onclick="addItemToBasket(this)"
                                                            >
                                                                <i class="icon-handbag"></i><span>Добавить</span></a>
                                                        </li>
                                                        <li><a style="cursor: pointer;"
                                                               data-item-id="{{$product->product_id}}"
                                                               data-method="add"
                                                               data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                               data-session-id="{{ Session::getId()}}"
                                                               data-route="{{route('favorite.isAjax')}}"
                                                               onclick="addItemToFavorites(this)"
                                                            >
                                                                <i class="fa fa-heart"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="icomoon icon-exchange"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="txt">
                                            <strong class="title"><a
                                                        href="{{ route('product.detail',$product->product_id, ['id' => $product->product_id]) }}">{{$product->product_name}}</a></strong>
                                            <span class="price"><i
                                                        class="fa fa-dollar"></i> <span>{{$product->product_price}}</span> 	({{$product->product_price * (\App\Models\Currency::where(['currency_id' => 1])->first())->money}} &#8376;)</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-patners wow fadeInUp" data-wow-delay="0.4s">
                        <h2 class="heading">Наши бренды</h2>
                        <div class="patner-slider">
                            @foreach($brands as $brand)
                                <div class="slide">
                                    <div class="box1">
                                        <div class="box2">
                                            <a href="#">
                                                <img src="{{$brand->image}}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="banner-frame nospace wow fadeInUp" data-wow-delay="0.4s">
                        <h2 class="heading" style="letter-spacing: 1px; ">ПРОДВИЖЕНИЕ В INSTAGRAM</h2>
                        <div style="margin-top: 3rem;">
                            <div class="banner-9">
                                <img src="/new_design/images/insta_1.png" alt="image description">
                                <div class="holder">
                                    <h2><span>Хочешь</span><strong>1 млн. подписчиков?</strong></h2>
                                    <a class="btn-shop" href="product-detail.html">
                                        <span>Хочу</span>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="banner-10">
                                <img src="/new_design/images/insta_2.png" alt="image description">
                                <div class="holder">
                                    <h2><span>Продвигай</span><strong>свой аккаунт</strong></h2>
                                    <a class="btn-shop" href="product-detail.html">
                                        <span>Продвигать</span>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="banner-11">
                                <img src="/new_design/images/insta_3.png" alt="image description">
                                <div class="holder">
                                    <h2><span>Зарабатывай</span><strong>от 1000$ за 1 пост</strong></h2>
                                    <a class="btn-shop" href="product-detail.html">
                                        <span>Зарабатывать</span>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(App::environment('hola'))
                        <div class="mt-producttabs style4 wow fadeInUp" data-wow-delay="0.4s">
                            <h2 class="heading">МЫ В INSTAGRAM</h2>
                            <div class="tab-content">
                                <div id="tab1">
                                    <div class="tabs-sliderlg">
                                        <div class="slide">
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">
                                                            <a href="https://www.instagram.com/p/B_17-MYJDaU/?igshid=1jr9c3tss0z8q"
                                                               target="_blank">
                                                                <div class="insta_image" 
                                                                    style="background-image: url('https://www.instagram.com/p/B_17-MYJDaU/media/?size=m'); 
                                                                        background-size: contain;">
                                                                </div>
                                                            </a>
                                                            <ul class="links">
                                                                <li>
                                                                    <a href="https://www.instagram.com/p/B_17-MYJDaU/?igshid=1jr9c3tss0z8q"
                                                                       target="_blank"><i
                                                                                class="fa fa-search"></i><span>Подробнее</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide">
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">
                                                            <a href="https://www.instagram.com/p/B_yso1ygEKe/?igshid=1w9pvg8ny5dy3"
                                                               target="_blank">
                                                                <div class="insta_image" 
                                                                    style="background-image: url('https://www.instagram.com/p/B_yso1ygEKe/media/?size=m'); 
                                                                        background-size: contain;">
                                                                </div>                                                                
                                                            </a>
                                                            <ul class="links">
                                                                <li>
                                                                    <a href="https://www.instagram.com/p/B_yso1ygEKe/?igshid=1w9pvg8ny5dy3"
                                                                       target="_blank"><i
                                                                                class="fa fa-search"></i><span>Подробнее</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide">
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">
                                                            <a href="https://www.instagram.com/p/B_l0FblJOE2/?igshid=1o1kyh6pyy8fj"
                                                               target="_blank">
                                                               <div class="insta_image" 
                                                                    style="background-image: url('https://www.instagram.com/p/B_l0FblJOE2/media/?size=m'); 
                                                                        background-size: contain;">
                                                                </div>                                                               
                                                            </a>
                                                            <ul class="links">
                                                                <li>
                                                                    <a href="https://www.instagram.com/p/B_l0FblJOE2/?igshid=1o1kyh6pyy8fj"
                                                                       target="_blank"><i
                                                                                class="fa fa-search"></i><span>Подробнее</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide">
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">                                                            
                                                            <a href="https://www.instagram.com/p/B_hM0fdpGXv/?igshid=1dp0gvsveld2f"
                                                               target="_blank">
                                                               <div class="insta_image" 
                                                                    style="background-image: url('https://www.instagram.com/p/B_hM0fdpGXv/media/?size=m'); 
                                                                        background-size: contain;">
                                                                </div>
                                                            </a>
                                                            <ul class="links">
                                                                <li>
                                                                    <a href="https://www.instagram.com/p/B_hM0fdpGXv/?igshid=1dp0gvsveld2f"
                                                                       target="_blank"><i
                                                                                class="fa fa-search"></i><span>Подробнее</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide">
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">                                                            
                                                            <a href="https://www.instagram.com/p/B_ePhRGpXP7/?igshid=ueow4438kns0"
                                                               target="_blank">
                                                               <div class="insta_image" 
                                                                    style="background-image: url('https://www.instagram.com/p/B_ePhRGpXP7/media/?size=m'); 
                                                                        background-size: contain;">
                                                                </div>
                                                            </a>
                                                            <ul class="links">
                                                                <li>
                                                                    <a href="https://www.instagram.com/p/B_ePhRGpXP7/?igshid=ueow4438kns0"
                                                                       target="_blank"><i
                                                                                class="fa fa-search"></i><span>Подробнее</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="slide">
                                            <div class="mt-product1 large">
                                                <div class="box">
                                                    <div class="b1">
                                                        <div class="b2">                                                            
                                                            <a href="https://www.instagram.com/p/B_TygfspnQ5/?igshid=mhn1mobymsvz"
                                                               target="_blank">                                                              
                                                               <div class="insta_image" 
                                                                    style="background-image: url('https://www.instagram.com/p/B_TygfspnQ5/media/?size=m'); 
                                                                        background-size: contain;">
                                                                </div>
                                                            </a>
                                                            <ul class="links">
                                                                <li>
                                                                    <a href="https://www.instagram.com/p/B_TygfspnQ5/?igshid=mhn1mobymsvz"
                                                                       target="_blank"><i
                                                                                class="fa fa-search"></i><span>Подробнее</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>


@endsection