@extends('index.layout.layout')

@section('meta-tags')

    <title>Новости. Qpartners.kz</title>
    <meta name="description" content="Новости. Qpartners.kz - это группа единомышленников, которые уже имеют богатый опыт работы в МЛМ - индустрии, интернет-коммерции и обладают всеми необходимыми качествами для достижения поставленных целей" />
    <meta name="keywords" content="Новости, Qpartners.kz" />

@endsection


@section('content')

    <div class="container">

        <div class="breadcrumb-trail breadcrumbs">
            <span class="trail-browse"></span>
            <span class="trail-begin"></span>
            <span class="trail-end">&nbsp;</span>
        </div>
    </div>

    <div id="content" class="page-wrap fullwidth">
        <div class="container content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-page">
                        <div id="primary" class="content-area fullwidth">
                            <main id="main" class="site-main" role="main">
                                <div class="vc_row wpb_row vc_row-fluid themesflat_1501148753">
                                    <div class="row_overlay" style=""></div>
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner vc_custom_1494562006228">
                                            <div class="wpb_wrapper">
                                                <div class="title-section   vc_custom_1494564433649 ">
                                                    <h1 class="title">
                                                        Новости
                                                    </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row wpb_row vc_row-fluid themesflat_1501148753">
                                    <div class="row_overlay" style=""></div>

                                    @foreach($news as $key => $item)

                                        <div class="wpb_column vc_column_container vc_col-sm-4">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div class="themesflat_iconbox themesflat_custom_btn inline-left transparent  vc_custom_1496462588057">
                                                        <div class="iconbox-image">
                                                            <img src="{{$item->news_image}}?width=370&height=240"/>
                                                        </div>

                                                        <div class="iconbox-content">
                                                            <h5 class="title" style="font-size: 20px;font-weight: 500">
                                                                <a href="/news/{{\App\Http\Helpers::getTranslatedSlugRu($item['news_name_'.$lang])}}-u{{$item->news_id}}">{{$item['news_name_'.$lang]}}</a>
                                                            </h5>

                                                            <p style="letter-spacing: 0.1px; margin-bottom: 8px;">{{$item['news_desc_'.$lang]}}</p>

                                                            <p><a class="themesflat-button no-background"
                                                                  href="/news/{{\App\Http\Helpers::getTranslatedSlugRu($item['news_name_'.$lang])}}-u{{$item->news_id}}">Подробнее<i class="readmore-icon fa fa-chevron-right"></i></a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    @endforeach

                                </div>

                                <div class="col-md-12">
                                    {{ $news->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
                                </div>

                            </main><!-- #main -->
                        </div><!-- #primary -->

                </div>

            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>

@endsection


