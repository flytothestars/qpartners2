@extends('design_index.layout.layout')

@section('meta-tags')

    <title>Фото и видео галерея</title>
    <meta name="description"
          content="Qpartners.kz - это группа единомышленников, которые уже имеют богатый опыт работы в МЛМ - индустрии, интернет-коммерции и обладают всеми необходимыми качествами для достижения поставленных целей"/>
    <meta name="keywords" content="Qpartners.kz"/>

@endsection


@section('content')
    <main id="mt-main">
        <!-- Mt Contact Banner of the Page -->
        <section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s"
                 style="background-color: lightgrey;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Галерея</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt Contact Banner of the Page end -->

        <!-- Mt Blog Detail of the Page -->
        <div class="mt-blog-detail style4">
            <div class="container">
                <div class="row">
                    {{--                    <div class="col-xs-12 header wow fadeInUp" data-wow-delay="0.4s">--}}
                    {{--                        <!-- Breadcrumbs of the Page -->--}}
                    {{--                        <nav class="breadcrumbs">--}}
                    {{--                            <ul class="list-unstyled">--}}
                    {{--                                <li><a href="index.html">Home <i class="fa fa-angle-right"></i></a></li>--}}
                    {{--                                <li><a href="#">Blog</a></li>--}}
                    {{--                            </ul>--}}
                    {{--                        </nav>--}}
                    {{--                        <!-- Breadcrumbs of the Page end -->--}}
                    {{--                        <span class="category"><a href="#"><i class="fa fa-th"></i></a></span>--}}
                    {{--                        <ul class="list-unstyled align-right">--}}
                    {{--                            <li>--}}
                    {{--                                Search <a href="#"><i class="fa fa-search"></i></a>--}}
                    {{--                            </li>--}}
                    {{--                            <li>--}}
                    {{--                                Categories <a href="#"><i class="fa fa-bars"></i></a>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}
                    {{--                    </div>--}}
                </div>
                <div class="row">
                    <div class="col-xs-12 header-holder">
                        <h2>ГАЛЕРЕЯ ФОТО И ВИДЕО</h2>
                        <div class="txt-wrap">
                            <p>КОМПАНИЯ ЗАПУСТИЛА ОБНОВЛЕННЫЙ САЙТ</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="mt-iso" id="blog-isotops">
                            @foreach($gallery as $item)
                                <article class="post-blog wow fadeInLeft">
                                    <div class="img-holder" style=" position: relative;">
                                        <a href="{{route('gallery-detail.show', ['id' => $item->slider_id])}}">
                                            <div style="
                                                    background-image: url('{{$item->slider_image}}');
                                                    background-position: center;
                                                    background-repeat: no-repeat;
                                                    background-size: cover;
                                                    width: 375px;
                                                    height: 295px;
                                                    "></div>
                                        </a>
                                        <ul class="list-unstyled comment-nav">
                                            <li><a href="#"><i class="fa fa-comments"></i>12</a></li>
                                            <li><a href="#"><i class="fa fa-share-alt"></i>14</a></li>
                                        </ul>
                                        <div style="">
                                            <h2><a href="blog-right-sidebar.html"></a></h2></div>
                                    </div>
                                    <?php
                                    $day = date('d', strtotime($item->created_at));
                                    $month = date('m', strtotime($item->created_at));
                                    $month = \App\Http\Helpers::getMonthName($month);
                                    ?>
                                    <time class="time" datetime="2016-02-03 20:00">
                                        <strong><?= $day ?></strong><?= $month?></time>


                                    <div class="txt-holder">
                                        <p><?= $item->slider_name_ru ?></p>
                                    </div>
                                    <a href="blog-right-sidebar.html" class="btn-more"><i class="fa fa-angle-right"></i>
                                        Подробнее</a>
                                </article>
                            @endforeach

                            @foreach($videos as $video)
                                <article class="post-blog wow fadeInLeft">
                                    <div class="img-holder" style=" position: relative;">
                                        <a href="blog-right-sidebar.html">
                                            <iframe src="{{$video->video_text_ru}}" frameborder="0"
                                                    style=" width: 375px;height: 295px;"></iframe>
                                        </a>
                                        <ul class="list-unstyled comment-nav">
                                            {{--                                            <li><a href="#"><i class="fa fa-comments"></i>12</a></li>--}}
                                            {{--                                            <li><a href="#"><i class="fa fa-share-alt"></i>14</a></li>--}}
                                        </ul>
                                        <div style="">
                                            <h2><a href="blog-right-sidebar.html"></a></h2></div>
                                    </div>
                                    <?php
                                    $day = date('d', strtotime($item->created_at));
                                    $month = date('m', strtotime($item->created_at));
                                    $month = \App\Http\Helpers::getMonthName($month);
                                    ?>
                                    <time class="time" datetime="2016-02-03 20:00">
                                        <strong><?= $day ?></strong><?= $month?></time>
                                    <div class="txt-holder">
                                        <p><?= $item->slider_name_ru ?></p>
                                    </div>
                                    <a href="blog-right-sidebar.html" class="btn-more"><i class="fa fa-angle-right"></i>
                                        Подробнее</a>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="btn-holder">
                            {{ $gallery->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mt Blog Detail of the Page end -->
    </main>
@endsection

<style>
    #mt-main > div > div > div:nth-child(5) > div > div > ul {
        list-style-type: none;
    }
</style>