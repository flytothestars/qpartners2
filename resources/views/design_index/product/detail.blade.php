<?php

use Illuminate\Support\Facades\URL;


$tab = (explode('tab=', URL::current()));

?>
@extends('design_index.layout.layout')

@section('meta-tags')

    <title>Qpartners Shop</title>
    <meta name="description"
          content="«Qpartners» - это уникальный медиа проект с широким набором возожностей для взаймодествия с участниками виртуального рынка"/>
    <meta name="keywords" content="Qpartners"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

@endsection
@section('content')
    <i class="ajax-loader" id="ajax-loader"></i>
    <main id="mt-main">
        <!-- Mt Product Detial of the Page -->
        <section class="mt-product-detial wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">

                <div class="row">
                    <div class="col-xs-12">
                        <!-- Slider of the Page -->
                        <div class="slider">
                            <!-- Comment List of the Page -->
                            <ul class="list-unstyled comment-list">
                                <li><a href="#"><i
                                                class="fa fa-heart"></i>{{\App\Models\Product::getLike($product->product_id)}}
                                    </a></li>
                                <li><a href="#"><i class="fa fa-comments"></i>{{count($reviews)}}</a></li>
                            </ul>
                            <!-- Comment List of the Page end -->
                            <!-- Product Slider of the Page -->
                            <div class="product-slider">
                                <div class="slide">
                                    <div style="
                                            background-image: url('{{$product->product_image}}');
                                            background-size: contain;
                                            background-position: center;
                                            background-repeat: no-repeat;
                                            width: 610px;
                                            height: 490px;
                                            border: 1px solid lightgrey;
                                            border-radius: 5px;
                                            ">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slider of the Page end -->
                        <!-- Detail Holder of the Page -->
                        <div class="detial-holder">
                            <!-- Breadcrumbs of the Page -->
                            <ul class="list-unstyled breadcrumbs">
                                <li><a href="#">Продукция <i class="fa fa-angle-right"></i></a></li>
                                <li>{{$product->product_name_ru}}</li>
                            </ul>
                            <!-- Breadcrumbs of the Page end -->
                            <h2>{{ $product->product_name_ru }}</h2>
                            <!-- Rank Rating of the Page -->
                            <div class="rank-rating">
                                <ul class="list-unstyled rating-list">
                                    @for($i = 0; $i <  5; $i++)
                                        @if($i < \App\Models\Review::ratingCalculator($product->product_id, \App\Models\Review::PRODUCT_REVIEW))
                                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        @else
                                            <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                        @endif
                                    @endfor
                                </ul>
                                <span class="total-price">Отзывы ({{count($reviews)}})</span>
                            </div>
                            <!-- Rank Rating of the Page end -->
                            <div id="reload-heart">
                                <ul class="list-unstyled list">
                                    @if(Auth::user())
                                        <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg"><i
                                                        class="fa fa-share-alt"></i>Поделиться</a></li>
                                    @endif
                                    <li><a href="#"><i class="fa fa-exchange"></i>Сравнить</a></li>
                                    <li class=""><a style="cursor: pointer;"
                                                    data-item-id="{{$product->product_id}}"
                                                    data-method="add"
                                                    data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                    data-session-id="{{ Session::getId()}}"
                                                    data-route="{{route('favorite.isAjax')}}"
                                                    onclick="addItemToFavorites(this)"
                                        ><i class="fa fa-heart"
                                            style="color: {{\App\Models\Product::hasLiked($product->product_id, (Auth::user() ? Auth::user()->user_id : null)) ? 'red' : ''}};"></i>Добавить
                                            в избранные</a></li>
                                </ul>
                            </div>

                            <div class="txt-wrap">
                                <p>{{$product->product_desc_ru}}</p>
                            </div>
                            <div class="text-holder">
                                <span class="price">Цена: &nbsp; ${{$product->product_price}} &nbsp; ({{$product->product_price * (\App\Models\Currency::where(['currency_id' => 1])->first())->money}} &#8376;)</span>
                            </div>
                            <!-- Product Form of the Page -->
                            <div action="#" class="product-form">
                                <fieldset>
                                    <div class="row-val">
                                        <label for="product_count">Кол-во</label>
                                        <input type="number" value="1" id="product_count">
                                    </div>
                                    <div class="row-val">
                                        <button id="choosing_role" style="background: #00a65a;">Купить</button>
                                    </div>
                                    <div class="row-val">
                                        <button type="submit">Добавить в корзину</button>
                                    </div>                                    
                                </fieldset>
                                <div class="choose_role" >
                                    <h5> Для партнеров qpartners.club скидка 20% на все продукции. </h5>
                                    <p>Вы партнер или клиент (покупатель)?</p>
                                    <div style="margin: 40px auto 0; display: flex; justify-content: space-evenly;">
                                        <a href="/admin/online" class="btn btn-primary"> Партнер </a>
                                        <a id="buyProductOnline" data-id="{{ $product->product_id }}" class="btn btn-primary"> Клиент </a>
                                    </div>
                                </div>
                            </div>
                        <!-- Product Form of the Page end -->
                        </div>
                        <!-- Detail Holder of the Page end -->
                    </div>
                </div>
            </div>
        </section><!-- Mt Product Detial of the Page end -->
        <div class="product-detail-tab wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="mt-tabs text-center text-uppercase">
                            <li><a href="#tab1" class="{{!isset($tab[1]) ? 'active' : ''}}">Описание</a></li>
                            <li><a href="#tab2">Состав</a></li>
                            <li><a href="#tab3" class="{{isset($tab[1]) && $tab[1] == 'review' ? 'active' : ''}}">Отзывы({{count($reviews)}}
                                    )</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab1">
                                <p style="white-space: pre-line;font-weight: 400;font-size: 110%;">
                                    {{$product->full_description_ru}}
                                </p>
                            </div>
                            <div id="tab2">
                                <p style="white-space: pre-line;font-weight: 400;font-size: 110%;">
                                    {{$product->information}}
                                </p>
                            </div>
                            <div id="tab3">
                                <div class="product-comment">
                                    @foreach($reviews as $review)
                                        <div class="mt-box">
                                            <div class="mt-hold">
                                                <ul class="mt-star">
                                                    @for($i = 0; $i <= 5; $i++)
                                                        @if($i < $review->rating)
                                                            <li><i class="fa fa-star"></i></li>
                                                        @elseif($i > $review->rating)
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        @endif
                                                    @endfor
                                                </ul>
                                                <span class="name">{{$review->user_name}}</span>
                                                <?php $time = date('H:m d.m.Y', strtotime($review->created_at)) ?>
                                                <time datetime="2016-01-01">{{$time}}</time>
                                            </div>
                                            <p style="white-space: pre-line;">
                                                {{$review->review_text}}
                                            </p>
                                        </div>
                                    @endforeach




                                    {{ Form::open(['action' => ['Index\ReviewController@store'], 'method' => 'POST']) }}
                                    {{ Form::token() }}
                                    {{ Form::hidden('item_id', $product->product_id) }}
                                    {{ Form::hidden('review_type_id', \App\Models\Review::PRODUCT_REVIEW) }}
                                    <fieldset>
                                        @if ($errors->any())
                                            <div class="alert alert-danger" style="color: red;">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <h2>Добавить комментарий</h2>

                                        <div class="mt-row">
                                            <label style="color: black;">Рейтинг</label>
                                            <div class="rating">
                                                <input id="demo-1" type="radio" name="rating" value="1">
                                                <label for="demo-1">1 star</label>
                                                <input id="demo-2" type="radio" name="rating" value="2">
                                                <label for="demo-2">2 stars</label>
                                                <input id="demo-3" type="radio" name="rating" value="3">
                                                <label for="demo-3">3 stars</label>
                                                <input id="demo-4" type="radio" name="rating" value="4">
                                                <label for="demo-4">4 stars</label>
                                                <input id="demo-5" type="radio" name="rating" value="5">
                                                <label for="demo-5">5 stars</label>

                                                <div class="stars">
                                                    <label for="demo-1" aria-label="1 star" title="1 star"></label>
                                                    <label for="demo-2" aria-label="2 stars" title="2 stars"></label>
                                                    <label for="demo-3" aria-label="3 stars" title="3 stars"></label>
                                                    <label for="demo-4" aria-label="4 stars" title="4 stars"></label>
                                                    <label for="demo-5" aria-label="5 stars" title="5 stars"></label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="mt-row">
                                            {{ Form::label('Имя', null, ['class' => 'control-label', 'style'=> 'font-weight:bold;color:black;']) }}
                                            {{ Form::text('user_name',(Auth::user() ? Auth::user()->name : ''), ['class' => 'form-control'])}}
                                        </div>
                                        <div class="mt-row">
                                            {{ Form::label('E-mail', null, ['class' => 'control-label', 'style'=> 'font-weight:bold;color:black;']) }}
                                            {{ Form::text('user_email',(Auth::user() ? Auth::user()->email : '') , ['class' => 'form-control'])}}
                                        </div>
                                        <div class="mt-row">
                                            {{ Form::label('Отзыв', null, ['class' => 'control-label', 'style'=> 'font-weight:bold;color:black;']) }}
                                            {{ Form::textarea('review_text',null, ['class' => 'form-control'])}}
                                        </div>
                                        {{ Form::submit('Добавить отзыв', ['class'=> 'btn-type4']) }}
                                    </fieldset>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="related-products wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>ПОХОЖАЯ ПРОДУКЦИЯ</h2>
                        <div class="row">
                            <div class="col-xs-12">
                                @foreach($relatedProducts as $product)
                                    <div class="mt-product1 mt-paddingbottom20">
                                        <div class="box">
                                            <div class="b1">
                                                <div class="b2">
                                                    <a href="{{route('product.detail', ['id' => $product->product_id])}}">
                                                        <div style="
                                                                background-image: url('{{$product->product_image}}');
                                                                background-position: center;
                                                                background-repeat: no-repeat;
                                                                background-size: cover;
                                                                width: 215px;
                                                                height: 215px;
                                                                ">

                                                        </div>
                                                    </a>
                                                    <span class="caption">
{{--															<span class="new">NEW</span>--}}
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
                                                               data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                               data-method="add"
                                                               onclick="addItemToBasket(this)">
                                                                <i class="icon-handbag"></i><span>Добавить</span>
                                                            </a>
                                                        </li>
                                                        <li><a href="#"><i class="icomoon icon-heart-empty"></i></a>
                                                        </li>
                                                        <li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="txt">
                                            <strong class="title">
                                                <a href="{{route('product.detail', ['id' => $product->product_id])}}">
                                                    {{$product->product_name_ru}}
                                                </a>
                                            </strong>
                                            <span class="price"><i class="fa fa-dollar"></i>
                                                <span>
                                                    {{$product->product_price}} &nbsp;
                                                    ({{$product->product_price * \App\Models\Currency::usdToKzt()}} тг)
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade " id="order_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <div class="title-group"
                             style="margin-left: 20px; font-size: 120%; color: black; font-weight: 400;">
                            <h4 class="modal-title">Форма заявки</h4>                            
                        </div>
                    </div>
                    <div class="modal-body">
                        <form id="form_order" action="{{ route('smartpay_create_order_product') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="product_id" id="product_id">
                            <div id="user_not_partner">
                                <div class="form-group">
                                    <label for="username">ФИО</label>
                                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="ФИО">                              
                                </div>
                                <div class="form-group">
                                    <label for="contact">Контакт</label>
                                    <input type="text" class="form-control" id="contact" name="contact" placeholder="+7 (777) 777 77 77">
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="noreply@example.com">
                                </div>
                            </div>
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
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <div class="title-group"
                             style="margin-left: 20px; font-size: 120%; color: black; font-weight: 400;">
                            <h4 class="modal-title">Пригласить друга</h4>
                            <h5 class="modal-title">Вы можете поделиться со своими друзьями в социальной сети</h5>
                            <h5 class="modal-title">http://local.qpartners.club/1/admin</h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <ul style="list-style: none;">
                            <li>
                                <a href="https://api.whatsapp.com/send?text={{$url}}" style="
                                padding:5px 10px 5px 10px;
                                border: 2px solid lightgreen;
                                border-radius: 3px;
                                font-size: 130%;
                                ">
                                    <i style="font-weight: 500;color: lightgreen;" class="fa fa-whatsapp"></i>
                                    <span style="font-weight: 500;color: black;margin-left: 1rem;">Поделиться через Whatsapp</span>
                                </a>

                            </li>
                            <li style="margin-top: 15px;">
                                <a href="https://telegram.me/share/url?url={{$url}}" style="
                                padding:5px 10px 5px 10px;
                                border: 2px solid dodgerblue;
                                border-radius: 3px;
                                font-size: 130%;
                                ">
                                    <i style="
                                    background-image: url('https://bitnovosti.com/wp-content/uploads/2017/02/telegram-icon-7.png');
                                    background-position: center;
                                    background-size: cover;
                                    width: 18px;height: 18px;
                                    bottom: -5px;
                                    "
                                       class="fa fa-telegram"
                                    >

                                    </i>
                                    <span style="font-weight: 500;color: black;margin-left: 1rem;">Поделиться через Telegram</span>
                                </a>

                            </li>
                            <li style="margin-top: 15px;">
                                <a href="https://www.facebook.com/sharer.php?u={{$url}}" style="
                                padding:5px 10px 5px 10px;
                                border: 2px solid dodgerblue;
                                border-radius: 3px;
                                font-size: 130%;
                                ">
                                    <i style="font-weight: 500;color: dodgerblue;" class="fa fa-facebook"></i>
                                    <span style="font-weight: 500;color: black;margin-left: 1rem;">Поделиться через Facebook</span>
                                </a>

                            </li>
                            <li style="margin-top: 15px;">
                                <a href="http://vk.com/share.php?url={{$url}}" style="
                                padding:5px 10px 5px 10px;
                                border: 2px solid dodgerblue;
                                border-radius: 3px;
                                font-size: 130%;
                                ">
                                    <i style="font-weight: 500;color: dodgerblue;" class="fa fa-vk"></i>
                                    <span style="font-weight: 500;color: black;margin-left: 1rem;">Поделиться через VK</span>
                                </a>

                            </li>
                            <li style="margin-top: 15px;">
                                <a href="https://twitter.com/share?url={{$url}}" style="
                                padding:5px 10px 5px 10px;
                                border: 2px solid dodgerblue;
                                border-radius: 3px;
                                font-size: 130%;
                                ">
                                    <i style="font-weight: 500;color: dodgerblue;" class="fa fa-twitter"></i>
                                    <span style="font-weight: 500;color: black;margin-left: 1rem;">Поделиться через Twiiter</span>
                                </a>

                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
