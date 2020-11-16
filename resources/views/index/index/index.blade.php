@extends('index.layout.layout')

@section('meta-tags')

    <title>Qpartners</title>
    <meta name="description" content="«Qpartners» - это уникальный медиа проект с широким набором возожностей для взаймодествия с участниками виртуального рынка" />
    <meta name="keywords" content="Qpartners" />

@endsection

@section('content')

    <div id="content" class="page-wrap sidebar-left">
        <div class="main-slider">
            <div class="item-slid">
                <img src="/slider1.jpeg?v=2" alt="">
                <div class="text-slid">
                   {{-- <p>Проекты  Qazaq International Holding предлагают взаимовыгодное сотрудничество и возможность зарабатывать</p>--}}
                </div>
            </div>
            <div class="item-slid">
                <img src="/slider2.jpeg?v=2" alt="">
                <div class="text-slid">
                    {{-- <p>Проекты  Qazaq International Holding предлагают взаимовыгодное сотрудничество и возможность зарабатывать</p>--}}
                </div>
            </div>
            <div class="item-slid">
                <img src="/slider3.jpeg?v=2" alt="">
                <div class="text-slid">
                    {{-- <p>Проекты  Qazaq International Holding предлагают взаимовыгодное сотрудничество и возможность зарабатывать</p>--}}
                </div>
            </div>
            {{--<div class="item-slid">
                <img src="/slider/4.jpg?v=2" alt="">
                <div class="text-slid">
                    --}}{{-- <p>Проекты  Qazaq International Holding предлагают взаимовыгодное сотрудничество и возможность зарабатывать</p>--}}{{--
                </div>
            </div>--}}
        </div>
        <div class="container content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div id="primary" class="content-area-front-page">
                        <main id="main" class="site-main" role="main">
                            <div class="entry-content">
                                <div class="vc_row-full-width vc_clearfix"></div>
                                <div class="vc_row wpb_row vc_row-fluid vc_custom_1496458166465">
                                    <div class="row_overlay" style=""></div>

                                    @foreach($news as $key => $item)

                                        <div class="wpb_column vc_column_container vc_col-sm-4">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div class="themesflat_iconbox  inline-left transparent  vc_custom_1494487713818" >
                                                        <a href="/news/{{\App\Http\Helpers::getTranslatedSlugRu($item['news_name_'.$lang])}}-u{{$item->news_id}}">
                                                            <div class="iconbox-image">
                                                                <img src="{{$item->news_image}}?width=370&height=230" alt="" />
                                                            </div>
                                                        </a>
                                                        <div class="iconbox-content">
                                                            <h5 class="title" style="">
                                                                <a href="/news/{{\App\Http\Helpers::getTranslatedSlugRu($item['news_name_'.$lang])}}-u{{$item->news_id}}">{{$item['news_name_'.$lang]}}</a>
                                                            </h5>
                                                            <p>{{$item['news_desc_'.$lang]}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>

                                <div class="vc_row wpb_row vc_row-fluid themesflat_1501148697">
                                    <div class="row_overlay" style=""></div>
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner vc_custom_1491300752570">
                                            <div class="wpb_wrapper">
                                                <div class="title-section magb-28  ">
                                                    <h1 class="title">
                                                        Наши продукты
                                                    </h1>
                                                </div>
                                                <div class="themesflat-portfolio clearfix no">
                                                    <div class="portfolio-container  grid one-four show_filter_portfolio">

                                                        @foreach($project_list as $key => $item)

                                                            <div class="item travel-aviation ">
                                                                <div class="wrap-border">
                                                                    <a href="/project/{{\App\Http\Helpers::getTranslatedSlugRu($item['project_name_'.$lang])}}-u{{$item->project_id}}">
                                                                        <div class="featured-post ">
                                                                                <img src="{{$item->project_image}}?width=270&height=200" alt="">
                                                                        </div>
                                                                    </a>
                                                                    <div class="portfolio-details">
                                                                        <div class="category-post">
                                                                            <a href="" rel="tag"></a>
                                                                        </div>
                                                                        <div class="title-post">
                                                                            <a href="/project/{{\App\Http\Helpers::getTranslatedSlugRu($item['project_name_'.$lang])}}-u{{$item->project_id}}">{{$item['project_name_'.$lang]}}</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        @endforeach


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row-full-width vc_clearfix"></div>
                                <div class="vc_row-full-width vc_clearfix"></div>
                            </div><!-- .entry-content -->

                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div><!-- /.col-md-12 -->

            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>

@endsection

@section('js')
    <script>
        $(".main-slider").slick({
            arrows:true,
            dots:false,
            autoplay:true,
            autoplaySpeed:2000,
            speed:1200
        });
    </script>
@endsection

