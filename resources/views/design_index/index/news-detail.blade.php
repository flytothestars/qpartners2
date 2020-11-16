@extends('index.layout.layout')

@section('meta-tags')

    <title>{{$news['news_name_'.$lang]}}</title>
    <meta name="description" content="{{$news['news_name_'.$lang]}}. Qpartners.kz" />
    <meta name="keywords" content="Новости" />

@endsection

@section('content')

    <div class="container">

        <div class="breadcrumb-trail breadcrumbs">
            <span class="trail-browse"></span>
            <span class="trail-begin"></span>
            <span class="trail-end">&nbsp;</span>
        </div>
    </div>

    <div id="content" class="page-wrap sidebar-left">
        <div class="container content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div id="primary" class="">
                        <main id="main" class="post-wrap" role="main">


                            <article id="post-1053" class="post-1053 page type-page status-publish hentry">


                                <div class="entry-content">

                                    <div class="vc_row wpb_row vc_row-fluid themesflat_1501148752">
                                        <div class="row_overlay" style=""></div>
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <h1 style="letter-spacing: -1.01px; margin-bottom: 14px;">{{ $news['news_name_'.$lang]}}</h1>

                                                    {!! $news['news_text_'.$lang] !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <footer class="entry-footer"></footer>
                            </article><!-- #post-## -->


                        </main><!-- #main -->
                    </div><!-- #primary -->

                </div><!-- /.col-md-12 -->


            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- #content -->

@endsection


