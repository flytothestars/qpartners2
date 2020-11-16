@extends('index.layout.layout')

@section('meta-tags')

    <title>{{$project['project_name_'.$lang]}}</title>
    <meta name="description" content="{{$project['project_name_'.$lang]}}. Qpartners.kz - это группа единомышленников, которые уже имеют богатый опыт работы в МЛМ - индустрии, интернет-коммерции и обладают всеми необходимыми качествами для достижения поставленных целей" />
    <meta name="keywords" content="{{$project['project_name_'.$lang]}}, Qpartners.kz" />

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
                    <div id="primary" class="content-area sidebar-left">
                        <main id="main" class="post-wrap" role="main">


                            <article id="post-1053" class="post-1053 page type-page status-publish hentry">


                                <div class="entry-content">

                                    <div class="vc_row wpb_row vc_row-fluid themesflat_1501148752">
                                        <div class="row_overlay" style=""></div>
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <h1 style="letter-spacing: -1.01px; margin-bottom: 14px;">{{ $project['project_name_'.$lang]}}</h1>

                                                    {!! $project['project_text_'.$lang] !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <footer class="entry-footer"></footer>
                            </article><!-- #post-## -->


                        </main><!-- #main -->
                    </div><!-- #primary -->


                    <div id="secondary" class="widget-area" role="complementary">
                        <div class="sidebar">
                            <div id="nav_menu-4" class="widget widget_nav_menu">
                                <div class="menu-vertical-menu-container">
                                    <ul id="menu-vertical-menu" class="menu">

                                        @foreach($project_list as $key => $item)

                                            <li id="menu-item-1062" class="menu-item menu-item-type-post_type menu-item-object-page @if($item->project_id == $project->project_id) current-menu-item @endif page_item page-item-1053  menu-item-1062"><a href="/project/{{\App\Http\Helpers::getTranslatedSlugRu($item['project_name_'.$lang])}}-u{{$item->project_id}}">{{$item['project_name_'.$lang]}}</a></li>

                                        @endforeach

                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div><!-- #secondary -->
                </div><!-- /.col-md-12 -->


            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- #content -->

@endsection


