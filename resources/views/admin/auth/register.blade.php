<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>Qpartners.kz</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="/admin/auth/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/auth/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/auth/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/admin/css/bootstrap-select.css">
    <link href="/admin/css/admin.css?v=2" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="/favicon.png?v=4" />

</head>
<body class="bg-black admin-background">
<div class="form-box register-box" id="login-box">
    <div style="text-align: center">
        <a href="/">
            <img class="logo_svg" src="/logo_main.png?v=3" style="max-width: 220px; margin-bottom: 20px" />
        </a>
    </div>
    <div class="header">Регистрация</div>
    <form method="post" action="/register">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="body bg-gray">
            <div class="row">
                <div class="col-md-12">
                    <p style="color:red">@if(isset($error)){{$error}}@endif</p>
                </div>
                <div class="col-md-4">
                    <input type="hidden" name="is_left_config" value="@if(isset($_GET['left'])){{$_GET['left']}}@endif"/>
                    <div class="form-group">
                        <input required type="text" name="name" value="{{$row->name}}" class="form-control" placeholder="Имя"/>
                    </div>
                    <div class="form-group">
                        <input required type="text" name="last_name" value="{{$row->name}}" class="form-control" placeholder="Фамилия"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="middle_name" value="{{$row->middle_name}}" class="form-control" placeholder="Отчество"/>
                    </div>
                    <div class="form-group">
                        <select required name="recommend_user_id" data-placeholder="Выберите спонсора" class="form-control selectpicker" data-live-search="true">
                            <option value="">Выберите спонсора</option>
                            @foreach($recommend_row as $item)
                                <option @if($row->recommend_user_id == $item->user_id || (isset($_GET['id']) && $_GET['id'] == $item->user_id) ) {{'selected'}} @endif value="{{$item->user_id}}">{{$item['login']}} {{--({{$item['last_name']}} {{$item['name']}} {{$item['middle_name']}})--}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="login" value="{{$row->login}}" class="form-control" placeholder="Логин"/>
                    </div>
                    <div class="form-group">
                        <input required type="email" name="email" class="form-control" value="{{$row->email}}" placeholder="Email"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input required type="password" value="{{$row->password}}" name="password" class="form-control" placeholder="Пароль"/>
                    </div>
                    <div class="form-group">
                        <input required type="password" value="{{$row->confirm_password}}" name="confirm_password" class="form-control" placeholder="Повторите пароль"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="iin" value="{{$row->iin}}" class="form-control" placeholder="ИИН"/>
                    </div>
                    <div class="form-group">
                        <input required type="text" name="phone" value="{{$row->phone}}" class="form-control" placeholder="Телефон"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="instagram" value="{{$row->instagram}}" class="form-control" placeholder="Инстаграм аккаунт"/>
                    </div>
                    <div class="form-group">
                        <select required name="office_director_id" data-placeholder="Выберите директора офиса" class="form-control selectpicker" data-live-search="true">
                            <option value="">Выберите офис</option>
                            @foreach($office_row as $item)
                                <option @if($row->office_director_id == $item->user_id || (isset($_GET['id']) && $_GET['id'] == $item->user_id)) {{'selected'}} @endif value="{{$item->user_id}}">{{$item['office_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select onchange="getCityListByCountry(this)" required name="country_id" data-placeholder="Выберите страну" class="form-control" data-live-search="true">
                            <option value="">Выберите страну</option>
                            @foreach($country_row as $item)
                                <option @if($row->country_id == $item->country_id) {{'selected'}} @endif value="{{$item->country_id}}">{{$item['country_name_ru']}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <select id="city_id" required name="city_id" data-placeholder="Выберите город" class="form-control" data-live-search="true">
                            <option value="">Выберите город</option>
                            @foreach($city_row as $item)
                                <option @if($row->city_id == $item->city_id) {{'selected'}} @endif value="{{$item->city_id}}">{{$item['city_name_ru']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input required type="text" name="address" value="{{$row->address}}" class="form-control" placeholder="Район"/>
                    </div>
                </div>
                <div class="col-md-12 agree-label">
                    <input required  type="checkbox" value="1" id="agree_checkbox"> Регистрируясь на сайте вы подтверждаете, что ознакомлены с <a target="_blank" style="font-weight: bold" href="/file/dogovor_QT.pdf">Договором</a> и <a target="_blank" style="font-weight: bold" href="/presentation/qaz.pdf?v=1">презентацией</a>.
                </div>
            </div>
        </div>
        <div class="footer">
            <button type="submit" class="btn bg-olive btn-block" style="font-size: 17px">Зарегистрироваться</button>
            <div class="form-group" style="text-align: center">
                Если Вы уже зарегистрированы на нашем сайте, нажмите <a style="font-weight: bold; text-decoration: underline" href="/login">«Войти»</a>
            </div>
            <div class="form-group" style="text-align: center">
               <a style="font-weight: bold; text-decoration: underline;" href="/">Главная страница</a>
            </div>
        </div>

    </form>
</div>

<script src="/admin/js/jquery-1.11.0.js"></script>
<script src="/admin/js/bootstrap.min.js"></script>
<script src="/admin/js/bootstrap-select.js"></script>
<script src="/custom/js/custom.js?v=1"></script>

</body>
</html>