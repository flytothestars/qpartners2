<?php
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

$categories = Category::where(['is_show' => true])->limit(15)->get();
$MAC = exec('getmac');
$MAC = strtok($MAC, ' ');
if (Auth::user()) {
    $favorites = \App\Models\Favorite::where(['user_id' => Auth::user()->user_id])->get();
} else {
    $favorites = \App\Models\Favorite::where(['ip_address' => $MAC])->get();
}
$needSubsidiaryIds = [5, 7, 8];
$subsidiaries = \App\Models\Brand::whereIn('id', $needSubsidiaryIds)->get();

?>
<header id="mt-header" class="style3">
    <div class="mt-top-bar">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 hidden-xs">
                    {{-- @foreach($subsidiaries as $key => $subsidiary)
                        <a href="{{route('coming-soon', ['id' => $subsidiary->id])}}" class="tel"
                           style="
                           {{$key ? 'margin-left:1px;' : ''}}
                                   " data-toggle='tooltip' data-placement='bottom' title='{{$subsidiary->name}}'>
                            <span style="
                             padding:0 14px 0 14px;
                             color: white;
                             {{ $key <= count($subsidiary) ? 'border-right: 1px solid lightgrey;' : ''}}
                                    ">{{$subsidiary->name}}</span>
                        </a>
                    @endforeach --}}
                </div>
                <div class="col-xs-12 col-sm-6 text-right">
                    <ul class="mt-top-list">
                        <li class="hidden-xs">
                            <a href="{{route('shop.show')}}">Магазин</a>
                        </li>
                        <li class="hidden-xs">
                            <div class="dropdown">
                                <a class="icl_lang_sel_current icl_lang_sel_native">{{Lang::get('app.lang')}}</a>
                                <div class="dropdown-content">
                                    <a href="{{\App\Http\Helpers::setSessionLang('kz',$request)}}">
                                        Қазақша
                                    </a>
                                    <a href="{{\App\Http\Helpers::setSessionLang('ru',$request)}}">
                                        Русский
                                    </a>
                                    <a href="{{\App\Http\Helpers::setSessionLang('en',$request)}}">
                                        English
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="">
                            <div class="dropdown">
                                <a class="" href="#">{{Lang::get('app.cabinet')}}</a>
                                <div class="dropdown-content">
                                    @if(!Auth::check())
                                        <a href="/register">Регистрация</a>
                                        <a href="/login">Войти</a>
                                    @else
                                        <a href="/admin/index">Личный кабинет</a>
                                    @endif

                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-bottom-bar">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="mt-logo"><a href="/"><img src="/new_design/images/logo/logo.png" alt="schon"
                                                          style="height: 45px; width: 135px;margin-top: -4px;"></a>
                    </div>
                    <?php $totalPrice = 0;?>
                    <?php $total = 0;?>
                    @if(Auth::user())
                        <?php $items = \App\Models\UserBasket::where(['user_id' => \Illuminate\Support\Facades\Auth::user()->user_id])->get(); ?>
                        <?php foreach ($items as $item): ?>
                        <?php $total = (\App\Models\Product::where(['product_id' => $item->product_id])->first()); ?>
                        <?php $totalPrice += $total ? $total->product_price : 0; ?>
                    <?php endforeach ?>
                    @endif
                    <a href="{{ route('basket.show') }}" class="mt-sh-cart hidden-xs" id="basket-box">
                        <span class="icon-handbag"></span>
                        <strong>Ваша корзина</strong>
                        <span>{{isset($items) ? count($items) : 0}} продукта &nbsp; <i class="fa fa-dollar"></i>{{$totalPrice}}</span>
                    </a>
                    <ul class="mt-icon-list">
                        <li class="hidden-lg hidden-md">
                            <a href="#" class="bar-opener mobile-toggle">
                                <span class="bar"></span>
                                <span class="bar small"></span>
                                <span class="bar"></span>
                            </a>
                        </li>
                        <li></li>
                        <li><a style="color: red;" href="{{route('favorite.showUserItem')}}"
                               class="icon-heart hidden-xs"><span id="favoriteCount">{{count($favorites)}}</span></a></li>
                    </ul>
                    <nav id="nav">
                        <ul>
                            <li>
                                <a class="drop-link" href="">О НАС<i class="fa fa-angle-down"
                                                                     aria-hidden="true"></i></a>
                                <div class="s-drop">
                                    <ul>
                                        <li><a href="/about_us/guide">Руководство компании</a></li>
                                        <li><a href="/about_us/administration">Администрация компании</a></li>
                                        <li><a href="/about_us/leaders">Лидеры компании</a></li>
                                        <li><a href="{{route('faq.show')}}">часто задаваемые вопросы</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="drop">
                                <a href="#">ПРОДУКЦИЯ<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <div class="mt-dropmenu text-left">
                                    <div class="mt-frame">
                                        <div class="mt-f-box">
                                            <div class="row">
                                                <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                                                    <?php foreach($categories as $category): ?>
                                                    <div class="mt-col-3">
                                                        <div class="sub-dropcont">
                                                            <strong class="title"><a href="product-grid-view.html"
                                                                                     class="mt-subopener">{{$category->name}}</a></strong>
                                                            <div class="sub-drop">
                                                                <?php $products = \App\Models\Product::where(['category_id' => $category->id])->get(); ?>
                                                                @foreach($products as $product)
                                                                    <ul>
                                                                        <li><a href="/product/{{$product->product_id}}">
                                                                                {{ $product->product_name_ru}}</a></li>
                                                                    </ul>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php  endforeach; ?>
                                                </div>
                                                <div class="col-4 col-sm-4 col-md-4 xol-lg-4 col-xl-4 ">
                                                    <div class="mt-col-3 promo">
                                                        <div class="mt-promobox" style="position: relative;">
                                                            <a href="register"><img
                                                                        src="/new_design/images/program_banner.png"
                                                                        alt="promo banner"
                                                                        class="img-responsive">
                                                                <div style="position: absolute; bottom: 8px;right: 16px;">
                                                                    <a
                                                                            href="register"
                                                                            class="btn btn-warning">Регистрация</a>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- mt f box end here -->
                                    </div>
                                    <!-- mt frame end here -->
                                </div>
                                <span class="mt-mdropover"></span>
                            </li>
                            <li class="drop">
                                <a href="#">ПРОГРАММЫ <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <div class="mt-dropmenu text-left">
                                    <!-- mt frame start here -->
                                    <div class="mt-frame">
                                        <!-- mt f box start here -->
                                        <div class="mt-f-box">
                                            <!-- mt col3 start here -->
                                            <div class="mt-col-3">
                                                <div class="sub-dropcont">
                                                    <strong class="title"><a href="product-grid-view.html"
                                                                             class="mt-subopener">Жилье</a></strong>
                                                   <!--  <div class="sub-drop">
                                                        <ul>
                                                            <li><a href="product-grid-view.html">Стоимость жилья от
                                                                    16000$</a></li>
                                                            <li><a href="product-grid-view.html">Рассрочка до 44
                                                                    месяцев </a></li>
                                                            <li><a href="product-grid-view.html">Без процентов и
                                                                    комиссии</a></li>
                                                        </ul>
                                                    </div> -->
                                                </div>
                                                <div class="sub-dropcont">
                                                    <strong class="title"><a href="#"
                                                                             class="mt-subopener">Автомобиль</a></strong>
                                               <!--      <div class="sub-drop">
                                                        <ul>
                                                            <li><a href="404-page.html">Стоимость автомобиля от
                                                                    6000$</a></li>
                                                            <li><a href="404-page.html">Рассрочка до 15 месяцев</a></li>
                                                            <li><a href="404-page.html">Без процентов и комиссии</a>
                                                            </li>
                                                        </ul>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <!-- mt col3 end here -->

                                            <!-- mt col3 start here -->
                                            <div class="mt-col-3">
                                                <div class="sub-dropcont">
                                                    <strong class="title"><a href="#"
                                                                             class="mt-subopener">Бизнес</a></strong>
                                                    <div class="sub-drop">
                                                        <ul>
                                                            <li><a href="about-us.html">Грант на бизнес от 4000$</a>
                                                            </li>
                                                            <li><a href="about-us.html">Рассрочка до 10 месяцев</a></li>
                                                            <li><a href="about-us.html">Без процентов и комиссии</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="sub-dropcont">
                                                    <strong class="title"><a href="#"
                                                                             class="mt-subopener">Путешествие</a></strong>
                                                    <div class="sub-drop">
                                                        <ul>
                                                            <li><a href="contact-us.html">Путевки на сумму от 1000$</a>
                                                            </li>
                                                            <li><a href="contact-us.html">Рассрочка до 6 месяцев</a>
                                                            </li>
                                                            <li><a href="contact-us.html">Без процентов и комиссии</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- mt col3 end here -->

                                            <!-- mt col3 start here -->
                                            <div class="mt-col-3">
                                                <div class="sub-dropcont">
                                                    <strong class="title"><a href="#"
                                                                             class="mt-subopener">Продвижение в
                                                            INSTAGRAM</a></strong>
                                                    <div class="sub-drop">
                                                        <ul>
                                                            <li><a href="#">Более 1 млн подписчиков</a></li>
                                                            <li><a href="#">В период от 6 до 15 недель</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="sub-dropcont">
                                                    <strong class="title"><a href="#"
                                                                             class="mt-subopener">Дисконтная
                                                            программа</a></strong>
                                                    <div class="sub-drop">
                                                        <ul>
                                                            <li><a href="#">Скидки на товары и услуги</a></li>
                                                            <li><a href="#">Более 100 компании</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="sub-dropcont">
                                                    <strong class="title"><a href="#"
                                                                             class="mt-subopener">Программа обучения</a></strong>
                                                    <div class="sub-drop">
                                                        <ul>
                                                            <li><a href="coming-soon.html">Интернет грамотность</a></li>
                                                            <li><a href="coming-soon.html">Финансовая грамотность</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- mt col3 end here -->

                                            <!-- mt col3 start here -->
                                            <div class="mt-col-3 promo">
                                                <div class="mt-promobox" style="position: relative;">
                                                    <a href="register"><img
                                                                src="/new_design/images/program_banner.png"
                                                                alt="promo banner"
                                                                class="img-responsive">
                                                        <div style="position: absolute; bottom: 8px;right: 16px;"><a
                                                                    href="register"
                                                                    class="btn btn-warning">Регистрация</a></div>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- mt col3 end here -->
                                        </div>
                                        <!-- mt f box end here -->
                                    </div>
                                    <!-- mt frame end here -->
                                </div>
                                <span class="mt-mdropover"></span>
                            </li>
                            <li>
                                <a class="drop-link" href="blog-right-sidebar.html">НОВОСТИ<i class="fa fa-angle-down"
                                                                                              aria-hidden="true"></i></a>
                                <div class="s-drop">
                                    <ul>
                                        <li><a href="/news">Новости компании</a></li>
                                        <li><a href="/news">Новости команды</a></li>
                                        <li><a href="{{route('gallery.show')}}">Фото и видео галерея</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a class="" href="/opportunity">Возможности</a>
                            </li>
                            <li>
                                <a class="drop-link" href="homepage1.html">КОНТАКТЫ<i class="fa fa-angle-down"
                                                                                      aria-hidden="true"></i></a>
                                <div class="s-drop">
                                    <ul>
                                        <li><a href="{{route('contact.show')}}">Головной офис</a></li>
                                        <li><a href="{{route('representative.show')}}">Представители</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="hide_nav_li">
                                <a href="{{route('shop.show')}}">Магазин</a>
                            </li>
                            <li class="hide_nav_li">
                                <a class="" href="{{ route('basket.show') }}">Корзина</a>
                            </li>

                            <li class="hide_nav_li">
                                <a class="" href="{{ route('favorite.showUserItem') }}">Избранные</a>
                            </li>

                            <li class="hide_nav_li nav_li_lang">
                                <a href="{{\App\Http\Helpers::setSessionLang('kz',$request)}}">
                                    KZ
                                </a>
                                <a href="{{\App\Http\Helpers::setSessionLang('ru',$request)}}">
                                    RU
                                </a>
                                <a href="{{\App\Http\Helpers::setSessionLang('en',$request)}}">
                                    EN
                                </a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <span class="mt-side-over"></span>
</header>

@section('js')
@endsection
<style>
    .dropbtn {
        color: white;
        padding: 16px;
        border: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

</style>