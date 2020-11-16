<?php
use App\Models\Category;
use App\Models\Product;
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
        <?php
        /** @var Category $category */
        /** @var Category $category_id */
        $category = Category::where(['id' => $category_id])->first();
        if ($category_id) {
            $image_url = $category->image;
        } else {
            $image_url = '/new_design/images/internet_shop.png';
        }
        ?>
        <section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s"
                 style="background-image: url('<?= $image_url ?>'); border-top:1px solid lightgrey;border-bottom: 1px solid lightgrey;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1><?= isset($category_id) ? (\App\Models\Category::where(['id' => $category_id])->first())->name : 'Магазин' ?> </h1>
                        <!-- Breadcrumbs of the Page -->
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="/">Главная <i class="fa fa-angle-right"></i></a></li><!-- 
                                <li><a href="/shop">Магазин <i class="fa fa-angle-right"></i></a></li> -->
                                <li>Магазин</li>
                            </ul>
                        </nav><!-- Breadcrumbs of the Page end -->
                    </div>
                </div>
            </div>
        </section><!-- Mt Contact Banner of the Page end -->
        <div class="container">
            <div class="row">
                <aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
                    <section class="shop-widget">
                        <h2>Категории</h2>
                        <!-- category list start here -->
                        <ul class="list-unstyled category-list">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{route('shop.show.category', ['category_id' => $category->id])}}">
                                        <span class="name">{{ $category->name  }}</span>
                                        <span class="num">{{ count(\App\Models\Product::where(['category_id'=>$category->id])->get()) }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                    <section class="shop-widget filter-widget bg-grey">
                        <h2>Фильтр</h2>
                        <span class="sub-title">Фильтр по назначению</span>
                        <!-- nice-form start here -->
                        <ul class="list-unstyled nice-form">
                            @foreach(\App\Models\Product::ITEM as $item)
                                <li>
                                    <label for="check-1">
                                        <input id="check-1" type="checkbox">
                                        <span class="fake-input"></span>
                                        <span class="fake-label">{{$item}}</span>
                                    </label>
                                    <span class="num"></span>
                                </li>
                            @endforeach
                        </ul><!-- nice-form end here -->
                        <span class="sub-title">Фильтр по цене</span>
                        <div class="price-range">
                            <div class="range-slider">
                                <span class="dot"></span>
                                <span class="dot dot2"></span>
                            </div>
                            <span class="price">Цена &nbsp;   $ 1 &nbsp;  -  &nbsp;   $ 1000</span>
                            <a href="#" class="filter-btn">Применить</a>
                        </div>
                    </section>
                </aside>
                <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">
                    <header class="mt-shoplist-header">
                        <div class="btn-box">
                            <ul class="list-inline">
                                <li>
                                    <a href="#" class="drop-link">
                                        Сортировка <i aria-hidden="true" class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="drop">
                                        <ul class="list-unstyled">
                                            <li><a href="#">По возрастанию цены</a></li>
                                            <li><a href="#">По убыванию цены</a></li>
                                            <li><a href="#">По дате</a></li>
                                            <li><a href="#">По популярности</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a class="mt-viewswitcher" href="#"><i class="fa fa-th-large"
                                                                           aria-hidden="true"></i></a></li>
                                <li><a class="mt-viewswitcher" href="#"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div><!-- btn-box end here -->
                        <!-- mt-textbox start here -->
                        <div class="mt-textbox">
                            <p>Показано <strong>1–9</strong> из <strong>65</strong></p>
                        </div><!-- mt-textbox end here -->
                    </header><!-- mt shoplist header end here -->
                    <!-- mt productlisthold start here -->
                    <ul class="mt-productlisthold list-inline">
                        @foreach($products as $product)
                            <li>
                                <div class="mt-product1">
                                    <div class="box">
                                        <div class="b1">
                                            <div class="b2">
                                                <a href="{{ route('product.detail', ['id' => $product->product_id])}}">
                                                    <div style="width: 276px; height: 286px; background-image: url('@if (isset($product->product_image)){{$product->product_image}} @else{{'/new_design/images/no-images.jpg'}}  @endif '); background-size: cover; background-position: center;"></div>
                                                </a>
                                                <ul class="links add">
                                                    <li><a
                                                                style="cursor: pointer;"
                                                                data-item-id="{{$product->product_id}}"
                                                                data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                                data-method="add"
                                                                onclick="addItemToBasket(this)"
                                                        ><i class="icon-handbag"></i><span></span></a></li>
                                                    <li><a style="cursor: pointer;"
                                                           data-item-id="{{$product->product_id}}"
                                                           data-method="add"
                                                           data-user-id="{{Auth::user() ? Auth::user()->user_id : NULL}}"
                                                           data-session-id="{{ Session::getId()}}"
                                                           data-route="{{route('favorite.isAjax')}}"
                                                           onclick="addItemToFavorites(this)"
                                                        ><i
                                                                    style="color: {{\App\Models\Product::hasLiked($product->product_id, (Auth::user() ? Auth::user()->user_id : null)) ? 'red' : ''}};"
                                                                    class="icomoon icon-heart-empty"></i></a></li>
                                                    <li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="txt">
                                        <strong class="title"><a
                                                    href="{{ route('product.detail', ['id' => $product->product_id])}}">{{$product->product_name_ru}}</a></strong>
                                        <span class="price"><i
                                                    class="fa fa-dollar"></i> <span>{{$product->product_price}}  &nbsp; ({{$product->product_price * (\App\Models\Currency::where(['currency_id' => 1])->first())->money}} &#8376;)</span></span>
                                    </div>
                                    <br>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <nav class="mt-pagination">
                        <ul class="list-inline">
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                        </ul>
                    </nav><!-- mt pagination end here -->
                </div>
            </div>
        </div>
    </main><!-- mt main end here -->
@endsection