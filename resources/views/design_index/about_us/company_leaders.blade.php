<?php
use App\Admin\SocialNetwork;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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
        <!-- Mt Content Banner of the Page -->
        <section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s"
                 style="background-color: lightgrey;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>{{$leader_ship->title}}</h1>
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
                        <div class="txt">
                            <h2>{{$leader_ship->title}} </h2>
                            <p style="white-space: pre-line;">
                                {{strip_tags($leader_ship->text_body)}}
                            </p>
                        </div>
                        <div class="mt-follow-holder">
                        {{--                            <span class="title">Follow Us</span>--}}
                        {{--                            <!-- Social Network of the Page -->--}}
                        {{--                            <ul class="list-unstyled social-network">--}}
                        {{--                                <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>--}}
                        {{--                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>--}}
                        {{--                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>--}}
                        {{--                                <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>--}}
                        {{--                            </ul>--}}
                        <!-- Social Network of the Page end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt About Section of the Page -->
        <!-- Mt Team Section of the Page -->
        <section class="mt-team-sec">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h3>Лидерский совет</h3>
                        <div class="holder">
                            @foreach($leaders  as $person)
                                <?php
                                /** @var Users $person */
                                $socialNetworks = DB::table('ref_social_network_items')
                                    ->where(['item_id' => $person->id])
                                    ->where(['type_id' => \App\Admin\SocialNetwork::LEADERS_PERSON])
                                    ->get();


                                if ($socialNetworks) {
                                    $socialNetworks = collect($socialNetworks)->all();
                                    $socialNetworks = Arr::pluck($socialNetworks, 'url', 'social_network_id');
                                    $faceBook = isset($socialNetworks[SocialNetwork::FACEBOOK]) ? $socialNetworks[SocialNetwork::FACEBOOK] : '';
                                    $twitter = isset($socialNetworks[SocialNetwork::TWITTER]) ? $socialNetworks[SocialNetwork::TWITTER] : '';
                                    $instagram = isset($socialNetworks[SocialNetwork::INSTAGRAM]) ? $socialNetworks[SocialNetwork::INSTAGRAM] : '';
                                }
                                ?>
                                <div class="col wow fadeInLeft" data-wow-delay="0.4s">
                                    <div class="img-holder">
                                        <a href="#">
                                            <div style="
                                                    background-image: url('{{$person->image}}');
                                                    background-size: cover;
                                                    background-repeat: no-repeat;
                                                    background-position: center;
                                                    width: 280px;
                                                    height: 290px;
                                                    "></div>
                                            <ul class="list-unstyled social-icon">
                                                <li><i onclick="location.href='{{$twitter}}';"
                                                       class="fa fa-twitter"></i></li>
                                                <li><i onclick="location.href='{{$faceBook}}';"
                                                       class="fa fa-facebook"></i></li>
                                                <li><i onclick="location.href='{{$instagram}}';"
                                                       class="fa fa-instagram"></i></li>
                                            </ul>
                                        </a>
                                    </div>
                                    <div class="mt-txt">
                                        <h4 style="white-space: pre-line;"><a href="#">{{$person->full_name}}</a></h4>
                                        <span style="white-space: pre-line;"
                                              class="sub-title">{{$person->address}} </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection