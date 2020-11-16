@extends('design_index.layout.layout')

@section('meta-tags')

    <title>Фото и видео галерея</title>
    <meta name="description"
          content="Qpartners.kz - это группа единомышленников, которые уже имеют богатый опыт работы в МЛМ - индустрии, интернет-коммерции и обладают всеми необходимыми качествами для достижения поставленных целей"/>
    <meta name="keywords" content="Qpartners.kz"/>

@endsection


@section('content')
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
                                <li><a href="#"><i class="fa fa-heart"></i>27</a></li>
                                <li><a href="#"><i class="fa fa-comments"></i>12</a></li>
                                <li><a href="#"><i class="fa fa-share-alt"></i>14</a></li>
                            </ul>
                            <!-- Comment List of the Page end -->
                            <!-- Product Slider of the Page -->
                            <div class="product-slider">
                                <div class="slide">
                                    <div style="
                                            background-image: url('{{$item->slider_image}}');
                                            background-size: cover;
                                            background-repeat: no-repeat;
                                            background-position: center;
                                            width: 610px;
                                            height: 490px;
                                            ">
                                    </div>
                                </div>
                                @foreach($items as $val)
                                    <div class="slide">
                                        <div style="
                                                background-image: url('{{$val->slider_image}}');
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                background-position: center;
                                                width: 610px;
                                                height: 490px;
                                                ">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Product Slider of the Page end -->
                            <!-- Pagg Slider of the Page -->
                            <ul class="list-unstyled slick-slider pagg-slider">
                                <li>
                                    <div style="
                                            background-image: url('{{$item->slider_image}}');
                                            background-size: cover;
                                            background-repeat: no-repeat;
                                            background-position: center;
                                            width: 105px;
                                            height: 105px;
                                            ">
                                    </div>
                                </li>
                                @foreach($items as $item)
                                    <li>
                                        <div style="
                                                background-image: url('{{$item->slider_image}}');
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                background-position: center;
                                                width: 105px;
                                                height: 105px;
                                                ">
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- Pagg Slider of the Page end -->
                        </div>
                        <!-- Slider of the Page end -->
                        <!-- Detail Holder of the Page -->
                        <div class="detial-holder">
                            <h2>{{$item->slider_name_ru}}</h2>
                            <!-- Rank Rating of the Page -->
                            <div class="rank-rating">
                                <ul class="list-unstyled rating-list">
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                </ul>
                                <span class="total-price">Reviews (12)</span>
                            </div>
                            <!-- Rank Rating of the Page end -->
                            <ul class="list-unstyled list">
                                <li><a href="#"><i class="fa fa-share-alt"></i>SHARE</a></li>
                                <li><a href="#"><i class="fa fa-exchange"></i>COMPARE</a></li>
                                <li><a href="#"><i class="fa fa-heart"></i>ADD TO WISHLIST</a></li>
                            </ul>
                            <div class="txt-wrap">
                                <p>Koila is a chair designed for restaurants and food lovers in general. Designed in
                                    collaboration with restaurant professionals, it ensures comfort and an ideal
                                    posture, as there are armrests on both sides of the chair.</p>
                                <p>Koila is a seat designed for restaurants and gastronomic places in general. Designed
                                    in collaboration with professional of restaurants and hotels field, this armchair is
                                    composed of a curved shell with a base in oak who has pinched the back upholstered
                                    in fabric or leather. It provides comfort and holds for ideal sitting position,the
                                    arms may rest on the sides ofthe armchair.</p>
                            </div>
                        </div>
                        <!-- Detail Holder of the Page end -->
                    </div>
                </div>
            </div>
        </section><!-- Mt Product Detial of the Page end -->
        <br>
        <br>
        <br>
    </main>
@endsection