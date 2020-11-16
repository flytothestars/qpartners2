@extends('design_index.layout.layout')

@section('meta-tags')
    <link rel="stylesheet" type="text/css" href="/new_design/css/opportunity.css">
    <link rel="stylesheet" href="/new_design/css/opportunity-responsive.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <title>Qpartners</title>
    <meta name="description"
          content="«Qpartners» - это уникальный медиа проект с широким набором возожностей для взаймодествия с участниками виртуального рынка"/>
    <meta name="keywords" content="Qpartners"/>

@endsection
<div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="height:700px; width:100%;padding-top: 50px;">
            <iframe id="myFrame" style="width: 100%; height: 100%;"
                    frameborder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true">
            </iframe>
        </div>
    </div>
</div>
@section('content')

    <main id="mt-main">
    <!-- Вверхняя секция для видео и текста справа -->
        <section class="jai" style="">
            <div class="block_forvideo">
                    <iframe width="90%" height="70%" src="https://www.youtube.com/embed/S69hSwYRZK8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div class="block_fortext">
                <h2>Добро пожаловать <br>в <strong style="color: #2c2c2c;">Qyran Partners Club</strong></h2>
            </div>

        </section>

    <!--конец секции для видео и текста  -->

        <section class="mt-section-1">
            <div class="container" style="margin-top: 0;padding-top: 0;">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="banner-frame" style="padding-top: 0;">
                            <div class="banner-15 right wow"
                                 style="width: 580px;
                             height: 540px;
                             background: white;
                             margin:0;
                             margin-left: 19px;
                            ">
                                <div class="holder">
                                    <div class="second-section-title">
                                        <h3 class="second-section-title-h3 text-center">
                                            <span style="color: black;font-weight: bold;">Построй</span> <span
                                                    style="font-weight: bold;color: rgb(255, 0, 0);">свой бизнес
                                            </span>

                                        </h3>
                                    </div>
                                    <div style="float: left; " class="second-section-text text-left">
                                    <span style="color: black;">
                                        Став Партнером компании Вы получите бонус
                                        <br> от 100 000 KZT в месяц и построить собственный 
                                        бизнес с доходом 10 000 000 KZT в месяц
                                    </span>
                                        <div class="video_box" style="
                                            background-image: url('/new_design/images/video/qyran_partners.jpg');
                                            background-size: cover;
                                            background-repeat: no-repeat;
                                            background-position: center;
                                        ">
                                            <div class="red_play_button" data-youtube-url="uhJikpNX-u8"
                                                 onclick="openModal(this)" style="cursor: pointer;"></div>
                                        </div>
                                    </div>
                                    <div class="text-center video_buttons">
                                        <div class="second-section-div-left">
                                            <a href="/register" class="second-section-button hover-red">СТАТЬ
                                                ПАРТНЕРОМ
                                            </a>
                                        </div>
                                        <div class="second-section-div-right">
                                            <a href="/presentation/marketing_plan.pdf"
                                               class="second-section-button hover-red" target="_blank">
                                                СКАЧАТЬ ПРЕЗЕНТАЦИЮ
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="red_border_video">
                            </div>
                            <div class="banner-15 right wow"
                                 style="width: 580px; height: 540px;background: white;margin:0;">
                                <div class="holder">
                                    <div class="second-section-title">
                                        <h3 class="second-section-title-h3">
                                            <span style="color: black;">БУДЬ</span>
                                            <span style="color: #05c100;">ЗДОРОВЫМ</span>
                                            <span style="color: black">И</span>
                                            <span style="color: #05c100;">СИЛЬНЫМ</span>
                                        </h3>
                                    </div>
                                    <div style="float: left; " class="second-section-text text-left">
                                    <span style="color: black;">
                                       Широкая линейка натуральной продукции, для <br>
                                       укрепления, очищения, востановления и <br>
                                        профилактики Вашего организма
                                    </span>
                                        <div class="video_box" style="
                                            background-image: url('/new_design/images/video/natural_market.jpg');
                                            background-size: cover;
                                            background-repeat: no-repeat;
                                            background-position: center;
                                            ">
                                            <div style="cursor: pointer;" class="green_play_button"
                                                 data-youtube-url="eKyZWdo8drM"
                                                 onclick="openModal(this)"></div>
                                        </div>
                                    </div>
                                    <div style="" class="text-center video_buttons">
                                        <div class="second-section-div-left">
                                            <a href="/presentation/normal_product.pdf" target="_blank" class="second-section-button br-green hover-green">
                                                СКАЧАТЬ КАТАЛОГ
                                            </a>
                                        </div>
                                        <div class="second-section-div-right">
                                            <a href="/shop" class="second-section-button br-green hover-green">
                                                ПЕРЕЙТИ В МАГАЗИН
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-section-2" style="
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-image: url('/new_design/images/opportunity/image_section_3.png');
            margin-left: auto;
            margin-right: auto;
        ">
            <div class="container">
                <div class="section-2-title" style="padding-bottom: 80px;">
                    <h1 class="h1-title"><span style="color: black;">Щедрые</span> <span
                                style="color: #ff0000;">80%</span></h1>
                    <h3 class="h3-title"><span style="color:#ff0000; ">с уникальным маркетинг планом</span></h3>
                    <div style="width: 100%;height: 100px;">
                        <h3 class="h3-title-what-you-get">Что <span style="color: #ff0000;">Вы получаете</span>?</h3>
                    </div>

                    <p>
                        Став Партнером Вы получаете полноценный доступ к Маркетинг плану и ко всем его <br>
                        Инструментам и Возможностям.
                    </p>
                    <div class="row what_you_get_icons_div" style="margin-top: 50px;">
                        <div class="col-xs-12 col-md-12 col-xs-12">
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2  text-center">
                                <div class="icon_image_div" style="
                                background-image: url('/new_design/images/opportunity/book_icon.png');
                            "></div>
                                <h2>Каталог <br>
                                    натуральной <br>
                                    продукции
                                </h2>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2   text-center">
                                <div class="icon_image_div" style="
                                background-image: url('/new_design/images/opportunity/copy_book.png');
                                width: 50px;
                                height: 50px;
                            "></div>
                                <h2>Презентация <br>
                                    Маркетинг <br>
                                    плана
                                </h2>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2  text-center">
                                <div class="icon_image_div" style="
                                background-image: url('/new_design/images/opportunity/debat_card.png');
                            "></div>
                                <h2>Онлайн <br>
                                    клубная <br>
                                    карта
                                </h2>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2  text-center">
                                <div class="icon_image_div" style="
                                background-image: url('/new_design/images/opportunity/had.png');
                            "></div>
                                <h2>Обучение <br>
                                    Партнеров <br>
                                    компании
                                </h2>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2  text-center">
                                <div class="icon_image_div" style="
                                background-image: url('/new_design/images/opportunity/assistmant.png');
                            "></div>
                                <h2>
                                    Ассортимент <br>
                                    Натуральной <br>
                                    продукции
                                </h2>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2  text-center">
                                <div class="icon_image_div" style="
                                background-image: url('/new_design/images/opportunity/home_car.png');
                                width: 50px;
                                height: 50px;
                            "></div>
                                <h2>
                                    Участие в <br>
                                    Социальных <br>
                                    программах
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-section-2" style="
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-image: url('/new_design/images/opportunity/image_section_3.png');
            margin-left: auto;
            margin-right: auto;
            margin-top: 2rem;
            padding-bottom: 60px;
        ">
            <div class="container">
                <div class="section-2-title">
                    <h3 class="what-we-offer-text"><span style="color: black;">Что мы</span> предлагаем Вам <span
                                style="color: black;">?</span></h3>
                    <p>
                        Мы предлагаем маркетинг план который обеспечит Вам высокий и стабильный доход. <br>
                        80% дохода от товарооборота, компания отдает в сеть. Вы можете начать получать <br>
                        доход от бонусов соответствующего пакета:
                    </p>
                    <div class="row row-1">
                        <div class="col-sm-6 col-md-6  col-lg-4 col-xl-3 col-xs-6">
                            <div class="red-border">
                            </div>
                            <div class="packet-body">
                                <div class="stars-box text-center">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                </div>
                                <div class="packet-name text-center">
                                    CLASSIC
                                </div>
                                <div class="bonus-text">
                                    <ul style="list-style: none;">
                                        <li>- Рекрутинговый</li>
                                        <li>- Структурный</li>
                                        <li>- Кэшбэк</li>
                                        <li>- Активационный</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xs-6">
                            <div class="red-border">
                            </div>
                            <div class="packet-body">
                                <div class="stars-box text-center">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                </div>
                                <div class="packet-name text-center">
                                    PREMIUM
                                </div>
                                <div class="bonus-text">
                                    <ul style="list-style: none;">
                                        <li>- Рекрутинговый</li>
                                        <li>- Структурный</li>
                                        <li>- Кэшбэк</li>
                                        <li>- Активационный</li>
                                        <li>- Квалификационный</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xs-6">
                            <div class="red-border">
                            </div>
                            <div class="packet-body">
                                <div class="stars-box text-center">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                </div>
                                <div class="packet-name text-center">
                                    ELITE
                                </div>
                                <div class="bonus-text">
                                    <ul style="list-style: none;">
                                        <li>- Рекрутинговый</li>
                                        <li>- Структурный</li>
                                        <li>- Кэшбэк</li>
                                        <li>- Активационный</li>
                                        <li>- Квалификационный</li>                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4 col-lg-offset-2 col-xl-3 col-xs-6">
                            <div class="red-border">
                            </div>
                            <div class="packet-body">
                                <div class="stars-box text-center">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                </div>
                                <div class="packet-name text-center">
                                    VIP
                                </div>
                                <div class="bonus-text ">
                                    <ul style="list-style: none;">
                                        <li>- Рекрутинговый</li>
                                        <li>- Структурный</li>
                                        <li>- Кэшбэк</li>
                                        <li>- Активационный</li>
                                        <li>- Квалификационный</li>
                                        <li>- Глобальный</li>                                                                                
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-4  col-xl-3 col-xs-6">
                            <div class="red-border">
                            </div>
                            <div class="packet-body">
                                <div class="stars-box text-center">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                    <img src="/new_design/images/opportunity/star.png" alt="">
                                </div>
                                <div class="packet-name text-center">
                                    GAP
                                </div>
                                <div class="bonus-text ">
                                    <ul style="list-style: none;">
                                        <li>- Рекрутинговый</li>
                                        <li>- Структурный</li>
                                        <li>- Кэшбэк</li>
                                        <li>- Активационный</li>
                                        <li>- Квалификационный</li>                                        
                                        <li>- Глобальный</li>
                                        <li>- Социальный</li>                                        

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 110px;">
                        <div class="download-marketing-div">
                            <a class="download-marketing" href="/presentation/marketing_plan.pdf" target="_blank">
                                СКАЧАТЬ МАРКЕТИНГ
                                <span>PDF</span>
                            </a>
                        </div>
                        <div class="download-marketing-div center-div">
                            <a href="{{route('coming-soon', ['id' => 9 ])}}" class="download-marketing"  target="_blank">
                                СМОТРЕТЬ ПРЕЗЕНТАЦИЮ
                                <span>MP4</span>
                            </a>
                        </div>
                        <div class="download-marketing-div">
                            <a class="download-marketing"
                               style="padding-right: 20px;cursor: pointer;"
                               href="/register">
                                СТАТЬ ПАРТНЕРОМ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="slider-3" style="margin-top: 100px;">
            <div class="container-fluid">
                <div class="centerslider-1">
                    <div class="holder section-3-holder" style="
                        background-size: cover;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-image: url('/new_design/images/opportunity/carusel_car.jpg');
                        margin-left: auto;
                        margin-right: auto;
                        position:relative;

                     ">
                        <div class="section-3-holder-div">
                            <h3>АВтопрограмма <span>GAP</span></h3>
                            <p>СТАВ ПАРТНЁРОМ ВЫ МОЖЕТЕ УЧАСТВОВАТЬ В ПРОГРАММЕ <br>
                                ПО ПРИОБРЕТЕНИЮ АВТОМОБИЛЯ ДО 6 000 000 ТГ.</p>
                        </div>
                        <div class="section-3-div">
                            <a href="">ПОДРОБНЕЕ &emsp; <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="holder section-3-holder" style="
                        background-size: cover;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-image: url('/new_design/images/opportunity/carusel_home.png');
                        margin-left: auto;
                        margin-right: auto;
                        position:relative;

                     ">
                        <div class="section-3-holder-div section-second-gap">
                            <h3>Жилищная программа <span>GAP</span></h3>
                            <p>СТАВ ПАРТНЁРОМ ВЫ МОЖЕТЕ УЧАСТВОВАТЬ В ПРОГРАММЕ <br>
                                по приобретению жилья от 16 000$.</p>
                        </div>
                        <div class="section-3-div">
                            <a href="">ПОДРОБНЕЕ &emsp; <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="holder section-3-holder" style="
                        background-size: cover;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-image: url('/new_design/images/opportunity/carusel_ship.jpg');
                        margin-left: auto;
                        margin-right: auto;
                        position:relative;

                     ">
                        <div class="section-3-holder-div section-third-gap">
                            <h3>Тур программа <span>GAP</span></h3>
                            <p>сТАВ ПАРТНЁРОМ ВЫ МОЖЕТЕ УЧАСТВОВАТЬ В ПРОГРАММЕ <br>
                                путешествия по всему миру.</p>
                        </div>
                        <div class="section-3-div">
                            <a href="">ПОДРОБНЕЕ &emsp; <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="holder section-3-holder" style="
                        background-size: cover;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-image: url('/new_design/images/opportunity/carusel_natural_market.jpg');
                        margin-left: auto;
                        margin-right: auto;
                        position:relative;

                     ">
                        <div class="section-3-holder-div section-third-gap">
                            <h3>МСБ программа <span>GAP</span></h3>
                            <p>Став Партнёром вы можете получить грант на открытие представительства
                                Natural Market в своем регионе.</p>
                        </div>
                        <div class="section-3-div">
                            <a href="">ПОДРОБНЕЕ &emsp; <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="row" style="padding-bottom: 150px;">
            <div class="container">
                <div class="col-xs-12">
                    <div class="mt-productsc style2 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="row">
                            <div class="col-xs-12 mt-heading text-uppercase text-center">
                                <h2 class="mini_video_heading">Истории <span style="color: #ff0000; ">успеха</span>
                                    наших партнёров</h2>
                                <p class="mini_video_p">Люди которые достигли своих целей вместе с нами</p>
                            </div>
                        </div>
                        <div id="mt-productscrollbar" class="row video_scollar">
                            <div class="mt-holder">
                                <div class="mt-product1 large">
                                    <div class="box">
                                        <div style="
                                             width: 350px;
                                             height: 200px;
                                             position: relative;
                                             background-color: black;
                                             display: flex;
                                             align-items: center;
                                             justify-content: center;
                                             background-image: url('/new_design/images/video/marat_and_woman.jpg');
                                             background-position: center;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                        ">
                                            <a href="">
                                                <div data-youtube-url="vf6sX0K4w6E" style="cursor: pointer;"
                                                     class="red_play_button"
                                                     onclick="openModal(this)">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="txt text-center" style="margin-top: 30px">
                                        <strong class="mini_video_title" style="">
                                            Вручение автомобиля <br>
                                            партнеру
                                        </strong>
                                    </div>
                                </div>
                                <div class="mt-product1 large">
                                    <div class="box">
                                        <div style="
                                             width: 350px;
                                             height: 200px;
                                             position: relative;
                                             background-color: black;
                                             display: flex;
                                             align-items: center;
                                             justify-content: center;
                                              background-image: url('/new_design/images/video/two_womans.jpg');
                                             background-position: center;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                        ">
                                            <a href="">
                                                <div data-youtube-url="X8YFOThoC9k" style="cursor: pointer;"
                                                     class="red_play_button"
                                                     onclick="openModal(this)">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="txt text-center" style="margin-top: 30px">
                                        <strong class="mini_video_title" style="">
                                            Вручение автомобиля <br>
                                            партнёру
                                        </strong>
                                    </div>
                                </div>
                                <div class="mt-product1 large">
                                    <div class="box">
                                        <div style="
                                             width: 350px;
                                             height: 200px;
                                             position: relative;
                                             background-color: black;
                                             display: flex;
                                             align-items: center;
                                             justify-content: center;
                                             background-image: url('/new_design/images/video/mans_and_girls.jpg');
                                             background-position: center;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                        ">
                                            <a href="">
                                                <div data-youtube-url="cBh56bfkwb0" style="cursor: pointer;"
                                                     class="red_play_button"
                                                     onclick="openModal(this)">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="txt text-center" style="margin-top: 30px">
                                        <strong class="mini_video_title" style="">
                                            Вручение автомобиля <br>
                                            партнёру
                                        </strong>
                                    </div>
                                </div>
                                <div class="mt-product1 large">
                                    <div class="box">
                                        <div style="
                                             width: 350px;
                                             height: 200px;
                                             position: relative;
                                             background-color: black;
                                             display: flex;
                                             align-items: center;
                                             justify-content: center;
                                             background-image: url('/new_design/images/video/car_with_bubble.jpg');
                                             background-position: center;
                                             background-size: cover;
                                             background-repeat: no-repeat;
                                        ">
                                            <a href="">
                                                <div data-youtube-url="5gJmiQKZoTg" style="cursor: pointer;"
                                                     class="red_play_button"
                                                     onclick="openModal(this)">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="txt text-center" style="margin-top: 30px">
                                        <strong class="mini_video_title" style="">
                                            Вручение автомобиля <br>
                                            партнёровру
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slider-5" style="background: transparent !important;padding-bottom: 100px;">
            <div class="container">
                <div class="why-we-are-text">
                    <h3>Почему вы должны <span style="color: #ff0000;"> работать с нами </span>?</h3>
                </div>
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <div class="red-border">
                        </div>
                        <div class="img-text-box">
                            <div class="benefit-img"
                                 style="
                            background-size: cover;
                            background-position: center;
                            background-repeat: no-repeat;
                            background-image: url('/new_design/images/opportunity/exclusive.png');
                            margin-left: auto;
                            margin-right: auto;
                            width: 150px;
                            height: 150px;
                        ">
                            </div>
                            <div class="benefit-text">
                                <p>высокодоходный <br>
                                    и УНИкальный <br>
                                    маркетинг-план
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="red-border">
                        </div>
                        <div class="img-text-box">
                            <div class="benefit-img"
                                 style="
                            background-size: cover;
                            background-position: center;
                            background-repeat: no-repeat;
                            background-image: url('/new_design/images/opportunity/24-7-hours.png');
                            margin-left: auto;
                            margin-right: auto;
                            width: 150px;
                            height: 150px;
                        ">
                            </div>
                            <div class="benefit-text">
                                <p>постоянная поддержка <br>
                                    со стороны администрации <br>
                                    и лидеров
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="img-text-box">
                            <div class="benefit-img"
                                 style="
                            background-size: cover;
                            background-position: center;
                            background-repeat: no-repeat;
                            background-image: url('/new_design/images/opportunity/natural.png');
                            margin-left: auto;
                            margin-right: auto;
                            width: 150px;
                            height: 150px;
                        ">
                            </div>
                            <div class="benefit-text">
                                <p>натуральная продукция <br>
                                    отечественного <br>
                                    производства
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="want-to-be-partner-box text-center">
                    <a href="/register" class="want-to-be-partner-box-a">
                        ХОЧУ СТАТЬ ПАРТНЕРОМ
                    </a>
                </div>
                <div class="share-button-box text-center">
                    <a href="#" class="share-button" data-toggle="modal" data-target="#share_modal">
                        поделиться
                    </a>
                </div>
            </div>
        </section>
        <section class="" style="background: rgba(232, 232, 232, 0.5); padding-top: 50px; padding-bottom: 50px;">
            <div class="container">
                <div class="col-xs-12" style="padding-bottom: 30px;">
                    <h2 class="have-a-question">Остались вопросы?</h2>
                    <span class="have-a-question-span">Напишите в любое время! </span>
                    {{Form::open(['action' => ['Index\FaqController@opportunityFaqStore'], 'method' => 'POST', 'class'=> 'contact-form' ])}}
                    {{Form::token()}}
                    <fieldset class="have-a-question-fieldset">
                        <input type="text" required name="user_name" class="form-control" placeholder="Имя">
                        <input type="email" required name="user_email" class="form-control" placeholder="E-Mail">
                        <input type="text" required name="user_phone" class="form-control" placeholder="Номер телефона">
                        <textarea rows="10" class="form-control" name="question"
                                  placeholder="Текст ..."></textarea>
                        <button type="submit" class="have-a-question-button">
                            Отправить
                        </button>
                    </fieldset>
                    {{Form::close()}}
                </div>
            </div>
        </section>

        <div class="modal fade bs-example-modal-lg" id="share_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <div class="title-group"
                             style="margin-left: 20px; font-size: 120%; color: black; font-weight: 400;">
                            <h4 class="modal-title">Пригласить друга</h4>
                            <h5 class="modal-title">Вы можете поделиться со своими друзьями в социальной сети</h5>
                            <h5 class="modal-title">http://local.qpartners.club/1/admin</h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <ul style="list-style: none;">
                            <li>
                                <a href="https://api.whatsapp.com/send?text={{$url}}" style="
                                padding:5px 10px 5px 10px;
                                border: 2px solid lightgreen;
                                border-radius: 3px;
                                font-size: 130%;
                                ">
                                    <i style="font-weight: 500;color: lightgreen;" class="fa fa-whatsapp"></i>
                                    <span style="font-weight: 500;color: black;margin-left: 1rem;">Поделиться через Whatsapp</span>
                                </a>

                            </li>
                            <li style="margin-top: 15px;">
                                <a href="https://telegram.me/share/url?url={{$url}}" style="
                                padding:5px 10px 5px 10px;
                                border: 2px solid dodgerblue;
                                border-radius: 3px;
                                font-size: 130%;
                                ">
                                    <i style="
                                    background-image: url('https://bitnovosti.com/wp-content/uploads/2017/02/telegram-icon-7.png');
                                    background-position: center;
                                    background-size: cover;
                                    width: 18px;height: 18px;
                                    bottom: -5px;
                                    "
                                       class="fa fa-telegram"
                                    >

                                    </i>
                                    <span style="font-weight: 500;color: black;margin-left: 1rem;">Поделиться через Telegram</span>
                                </a>

                            </li>
                            <li style="margin-top: 15px;">
                                <a href="https://www.facebook.com/sharer.php?u={{$url}}" style="
                                padding:5px 10px 5px 10px;
                                border: 2px solid dodgerblue;
                                border-radius: 3px;
                                font-size: 130%;
                                ">
                                    <i style="font-weight: 500;color: dodgerblue;" class="fa fa-facebook"></i>
                                    <span style="font-weight: 500;color: black;margin-left: 1rem;">Поделиться через Facebook</span>
                                </a>

                            </li>
                            <li style="margin-top: 15px;">
                                <a href="http://vk.com/share.php?url={{$url}}" style="
                                padding:5px 10px 5px 10px;
                                border: 2px solid dodgerblue;
                                border-radius: 3px;
                                font-size: 130%;
                                ">
                                    <i style="font-weight: 500;color: dodgerblue;" class="fa fa-vk"></i>
                                    <span style="font-weight: 500;color: black;margin-left: 1rem;">Поделиться через VK</span>
                                </a>

                            </li>
                            <li style="margin-top: 15px;">
                                <a href="https://twitter.com/share?url={{$url}}" style="
                                padding:5px 10px 5px 10px;
                                border: 2px solid dodgerblue;
                                border-radius: 3px;
                                font-size: 130%;
                                ">
                                    <i style="font-weight: 500;color: dodgerblue;" class="fa fa-twitter"></i>
                                    <span style="font-weight: 500;color: black;margin-left: 1rem;">Поделиться через Twiiter</span>
                                </a>

                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

<style>
    #mCSB_1_dragger_horizontal {
        background: #ff0000 !important;
    }
</style>
@section('js')
    <script>
        function openModal(tag_object) {
            var videoIdInYouTube = $(tag_object).data('youtube-url');
            var url = ('https://www.youtube.com/embed/' + videoIdInYouTube);
            document.getElementById("myFrame").src = url;
            $('#myModal').modal('toggle');
        }
    </script>
@endsection

