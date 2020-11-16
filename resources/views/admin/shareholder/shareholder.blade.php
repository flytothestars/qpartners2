@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">


                <div class="box-body">
                    <div class="box-header">
                        <h1 class="box-title main-title">
                            {{$title}}
                        </h1>
                        @if(Auth::user()->role_id == 1)
                            <a href="/admin/shareholder/user" style="float: right">
                                <button class="btn btn-primary box-add-btn">Добавить долю</button>
                            </a>
                        @endif
                        <div class="clear-float"></div>
                        <div>
                              <span style="margin-right: 20px"><b>Общая доля:</b> {{$row->user_share_sum}} доля</span>
                              <span style="margin-right: 20px"><b>Дольщики:</b> {{$row->user_share_count}}</span>
                              <span style="margin-right: 20px"><b>Поступления на сегодня:</b> {{$row->shareholder_profit_today}} $ ({{round($row->shareholder_profit_today * \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}тг)</span>
                              <span style="margin-right: 20px"><b>Средний счет:</b> {{$row->shareholder_average_mount}} $ ({{round($row->shareholder_average_mount * \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}тг)</span>
                        </div>
                    </div>
                    <div class="nav-tabs-custom">

                        <div class="tab-content" >
                            <div>
                                <form>
                                    <table id="news_datatable" class="table table-bordered table-striped table-css">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">№</th>
                                            <th style="width: 20px">Аватар</th>
                                            <th>Пользователь</th>
                                            <th>Спонсор</th>
                                            <th>Доля</th>
                                            <th>Страна/Город</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск"></td>
                                            <td><input value="{{$request->sponsor_name}}" type="text" class="form-control" name="sponsor_name" placeholder="Поиск"></td>
                                            <td></td>
                                            <td><input value="{{$request->city_name}}" type="text" class="form-control" name="city_name" placeholder="Поиск"></td>

                                        </tr>
                                        @foreach($row->row as $key => $val)

                                            <tr>
                                                <td> {{ $key + 1 }}</td>
                                                <td>
                                                    <div class="object-image client-image">
                                                        <a href="/admin/profile/{{$val->user_id}}" target="_blank">
                                                            <img src="{{$val->avatar}}">
                                                        </a>
                                                    </div>
                                                    <div class="clear-float"></div>
                                                </td>
                                                <td class="arial-font">
                                                    <a class="main-label" href="/admin/profile/{{$val->user_id}}" target="_blank"><p class="login">{{$val->login}}</p><p class="client-name">{{ $val->name }} {{ $val->last_name }} {{ $val->middle_name }}</p>@if($val->is_activated == 0) <p style="color: red">Не активирован</p> @endif</a>
                                                </td>
                                                <td class="arial-font">
                                                    <a class="main-label" href="/admin/profile/{{$val->recommend_id}}" target="_blank"><p class="login">{{$val->recommend_login}}</p><p class="client-name">{{ $val->recommend_name }} {{ $val->recommend_last_name }} {{ $val->recommend_middle_name }}</p></a>
                                                </td>
                                                <td class="arial-font">
                                                    <div>
                                                        {{ $val->user_share }} доля
                                                    </div>
                                                </td>
                                                <td class="arial-font">
                                                    <div>
                                                        {{ $val->country_name_ru }}
                                                    </div>
                                                    <div>
                                                        {{ $val->city_name_ru }}
                                                    </div>
                                                </td>

                                            </tr>

                                        @endforeach

                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="1" style="text-align: right"><b>Общая доля:</b></td>
                                            <td colspan="1">{{$row->user_share_sum}} доля</td>
                                            <td colspan="2"></td>
                                        </tr>

                                        </tbody>

                                    </table>
                                </form>
                            </div>

                        </div>
                    </div>


                    <div style="text-align: center">
                        {{ $row->row->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
                    </div>


                    <div class="nav-tabs-custom">

                        <div class="tab-content" >
                            <div>
                                <form class="submit_form">
                                    <table id="news_datatable" class="table table-bordered table-striped table-css">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">№</th>
                                            <th>Отправитель</th>
                                            <th style="width: 150px">Тип операция</th>
                                            <th style="width: 100px">Операция</th>
                                            <th>Количество</th>
                                            <th>Комментарий</th>
                                            <th>Дата</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <tr style="background-color: #ebebeb">
                                            <td></td>
                                            <td><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск"></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="3" style="text-align: center">
                                                от <input style="width: 35%; display: inline-block" value="{{$request->date_from}}" type="text" class="form-control datetimepicker-input date-submit" name="date_from" placeholder="Дата">
                                                - до <input style="width: 35%; display: inline-block" value="{{$request->date_to}}" type="text" class="form-control datetimepicker-input date-submit" name="date_to" placeholder="Дата">
                                                <input type="submit" value="ОК" style="padding: 5px 7px">
                                            </td>
                                        </tr>
                                        @foreach($row->user_operation as $key => $val)

                                            <tr>
                                                <td> {{ $key + 1 }}</td>
                                                <td class="arial-font">
                                                    <a class="main-label" @if(Auth::user()->role_id == 1) href="/admin/profile/{{$val->user_id}}" target="_blank" @endif><p class="login">{{$val->login}}</p>@if(Auth::user()->user_id == 1)<p class="client-name">{{ $val->name }} {{ $val->last_name }} {{ $val->middle_name }}</p>@endif</a>
                                                </td>
                                                <td class="arial-font">
                                                    {{ $val->operation_type_name_ru }} @if($val->operation_type_id == 9) "{{$val->fond_name_ru}}" @endif
                                                </td>
                                                <td class="arial-font">
                                                    {{ $val->operation_name_ru }}
                                                </td>
                                                <td class="arial-font">
                                                    @if($val->operation_type_id == 2)
                                                        {{ $val->money }} доля
                                                    @else
                                                        {{ round($val->money,2) }} $ ({{round($val->money * \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}тг)
                                                    @endif
                                                </td>
                                                <td class="arial-font">
                                                    {{ $val->operation_comment }}
                                                </td>
                                                <td class="arial-font">
                                                    {{ $val->date }}
                                                </td>
                                            </tr>

                                        @endforeach

                                        <tr>
                                            <td colspan="4" style="text-align: right"><b>Общая сумма:</b> </td>
                                            <td colspan="1"><b>{{$row->user_operation_sum}} $ ({{round($row->user_operation_sum * \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}тг)</b></td>
                                            <td colspan="3"></td>
                                        </tr>
                                        </tbody>

                                    </table>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div style="text-align: center">
                        {{ $row->user_operation->appends(\Illuminate\Support\Facades\Input::except('other_page'))->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection