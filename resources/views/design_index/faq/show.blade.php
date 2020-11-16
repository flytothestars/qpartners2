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
        <section class="mt-contact-banner" style="background-color: lightgrey;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Вопросы и ответы</h1>
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
{{--                                <li><a href="index.html">home <i class="fa fa-angle-right"></i></a></li>--}}
{{--                                <li>FAQ's</li>--}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt Content Banner of the Page end -->
        <!-- Mt About Section of the Page -->
        <section class="mt-about-sec" style="padding-bottom: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="txt wow fadeInUp" data-wow-delay="0.4s">
                            <h2>СПИСОК ЧАСТО ЗАДАВАЕМЫХ ВОПРОСОВ</h2>
                            <p>
                                Основная функция данного раздела является предотвращение дезинформации касательно
                                дейятельности и в целом самой компании
                                <br>
                                Учитывая частотность и важность задаваемых вопросов от наших Партнеров и Клиентов, мы
                                составили список самых основных и важных вопросов
                                <br>
                                Здесь Вы можете получить исчерпывающие ответы на интересующие Вас вопросы.
                                <br>
                                В будущем список часто задаваемых вопросов будет пополняться другими вопросами и
                                ответами на них
                                <br>
                                Если Вы не нашли вопроса с ответом который Вас интересует, то можете обратиться по
                                телефону указаным в разделе контакты
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt About Section of the Page -->
        <div class="container faq-section mt-about-sec">
            <div class="row txt">
                <div class="col-xs-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($faqs as $faq)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading{{$faq->id}}">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                           href="#collapse{{$faq->id}}" aria-expanded="false" aria-controls="collapse{{$faq->id}}">
                                            {{$faq->question}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{$faq->id}}" class="panel-collapse collapse" role="tabpanel"
                                     aria-labelledby="heading{{$faq->id}}">
                                    <div class="panel-body">
                                        <p>{{$faq->answer}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

