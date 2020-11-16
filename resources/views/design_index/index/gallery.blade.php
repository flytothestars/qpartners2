@extends('index.layout.layout')

@section('meta-tags')

    <title>Галерея. Qpartners.kz</title>
    <meta name="description" content="Галерея. Qpartners.kz - это группа единомышленников, которые уже имеют богатый опыт работы в МЛМ - индустрии, интернет-коммерции и обладают всеми необходимыми качествами для достижения поставленных целей" />
    <meta name="keywords" content="Галерея, Qpartners.kz" />

@endsection

@section('content')

    <!-- Page title -->
    <div class="page-title">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 page-title-container">
                    <h1>Галерея</h1>
                </div>
            </div>
        </div>
    </div>

    <div id="content" class="page-wrap fullwidth">
        <div class="container content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="themesflat-portfolio content-area">
                        <div class="themesflat-portfolio clearfix no">
                            <div class="portfolio-container  grid2 one-three show_filter_portfolio">

                                @foreach($gallery as $key => $item)

                                    <div class="item travel-aviation ">
                                        <div class="wrap-border">
                                            <div class="featured-post ">
                                                <img src="{{$item->slider_image}}?width=370&height=270" alt=""></div>
                                            <div class="portfolio-details">
                                                <div class="category-post">

                                                </div>
                                                <div class="title-post">
                                                    <a>{{$item['slider_name_'.$lang]}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                        </div>
                    </div><!-- /.portfolio-container -->


                </div><!-- /.col-md-12 -->


                <div class="col-md-12">
                    {{ $gallery->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
                </div>

            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>


@endsection


