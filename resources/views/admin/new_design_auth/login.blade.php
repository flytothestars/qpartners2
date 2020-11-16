@extends('design_index.layout.layout')

@section('meta-tags')

    <title>Qpartners</title>
    <meta name="description"
          content="«Qpartners» - это уникальный медиа проект с широким набором возожностей для взаймодествия с участниками виртуального рынка"/>
    <meta name="keywords" content="Qpartners"/>

@endsection
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@section('content')
    <main id="mt-main">
        <section class="mt-contact-banner"
                 style="background-color: lightgrey;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Войти</h1>
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                {{--                                <li><a href="index.html"> <i class="fa fa-angle-right"></i></a></li>--}}
                                {{--                                <li></li>--}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <section class="mt-detail-sec toppadding-zero">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-push-2">
                        <div class="holder" style="margin: 0;">
                            <div class="mt-side-widget">
                                <header class="text-center">
                                    <h1 style="margin: 0 0 5px;">Войти</h1>
                                    <p>Добро пожаловать!</p>
                                </header>
                                @if(isset($error))
                                    <div class="alert alert-danger" style="width: 100%;margin-bottom: -30px;">
                                        <div class="">
                                            <p style="color:red;">{{$error}}</p>
                                        </div>
                                    </div>
                                @elseif(isset($success))
                                    <div class="alert alert-success" style="width: 100%;margin-bottom: -30px;">
                                        <div class="">
                                            <p style="color:green;">{{$success}}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <form method="post" action="/login">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input required type="text" name="login"
                                       value="@if(isset($login)){{$login}}@endif" class="form-control input"
                                       placeholder="ID, Email или логин"/>
                                <input required type="password" name="password" class="form-control input"
                                       placeholder="Пароль"/>
                                <br>
                                <br>
                                <button type="submit" class="btn btn-danger btn-type1">Войти</button>
                            </form>
                            <header>
                                <div class="form-group already-registered-div">
                                    Если вы еще не зарегистрированы на нашем сайте, вы можете сделать это
                                    перейдя по
                                    ссылке <a href="/register"
                                              style="font-weight: bold; text-decoration: underline; color: black;">регистрация</a>
                                </div>
                            </header>
                            <div class="footer">
                                <div class="form-group" style="text-align: center">
                                    <div class="col-md-6 main-page-div">
                                        <a style="font-weight: bold; text-decoration: underline; color: black;"
                                           href="/reset-password">Забыли пароль?</a>
                                    </div>
                                    <div class="col-md-6 main-page-div">
                                        <a style="font-weight: bold; text-decoration: underline; color: black;"
                                           href="/">Главная страница</a>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection