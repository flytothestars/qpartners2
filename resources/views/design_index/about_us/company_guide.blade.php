@extends('design_index.layout.layout')
@section('meta-tags')

    <title>Qpartners Shop</title>
    <meta name="description"
          content="«Qpartners» - это уникальный медиа проект с широким набором возожностей для взаймодествия с участниками виртуального рынка"/>
    <meta name="keywords" content="Qpartners"/>

@endsection

@section('content')
    <main id="mt-main">
        <!-- Mt Content Banner of the Page -->
        <section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s" style="background-color: lightgrey;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Руководство компании</h1>
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                {{--                                <li><a href="index.html">home <i class="fa fa-angle-right"></i></a></li>--}}
                                {{--                                <li>About Us</li>--}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt Content Banner of the Page end -->
        <!-- Mt About Section of the Page -->
        <section class="mt-about-sec wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="txt remove-br">
                            <h2>{{$guide_text->title}}</h2>
                            <p style="white-space: pre-line;">
                                {{strip_tags($guide_text->text_body)}}
                            </p>
                            <p style="white-space: pre-line;"><strong
                                        style="white-space: pre-line;">{{$guide_text->author_full_name}}</strong>
                                {{$guide_text->author_responsibility}}
                            </p>
                        </div>
                        <div class="mt-follow-holder">
                            <span class="title">Follow Us</span>
                            <!-- Social Network of the Page -->
                            <ul class="list-unstyled social-network">
                                <!-- <li>
                                    <a target="_blank" href="/{{$guide_text->author_twitter_link}}"><i
                                                class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="{{$guide_text->author_facebook_link}}"><i class="fa fa-facebook"></i></a>
                                </li> -->
                                <li>
                                    <a href="{{$guide_text->author_whatsapp_link}}"><i class="fa fa-whatsapp"></i></a>
                                </li>
                                <li>
                                    <a href="{{$guide_text->author_instagram_link}}"><i class="fa fa-instagram"></i></a>
                                </li>
                            </ul>
                            <!-- Social Network of the Page end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
<style>
    br {
        display: none;
    }
</style>