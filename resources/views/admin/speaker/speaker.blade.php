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
                        <a href="/admin/speaker/user" style="float: right">
                            <button class="btn btn-primary box-add-btn">Добавить спикера</button>
                        </a>
                        <div class="clear-float"></div>
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
                                            <th>Cпонсор</th>
                                            <th>Страна/Город</th>
                                            <th style="width: 20px"></th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <tr>
                                            <td></td>
                                            <td><input type="hidden" value="1" name="level"></td>
                                            <td><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск"></td>
                                            <td><input value="{{$request->sponsor_name}}" type="text" class="form-control" name="sponsor_name" placeholder="Поиск"></td>
                                            <td><input value="{{$request->city_name}}" type="text" class="form-control" name="city_name" placeholder="Поиск"></td>
                                            <td></td>
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
                                                    <a class="main-label" href="/admin/profile/{{$val->user_id}}" target="_blank"><p class="login">{{$val->login}}</p>@if(Auth::user()->user_id == 1)<p class="client-name">{{ $val->name }} {{ $val->last_name }} {{ $val->middle_name }}</p>@endif</a>
                                                </td>
                                                <td class="arial-font">
                                                    <a class="main-label" href="/admin/profile/{{$val->recommend_id}}" target="_blank"><p class="login">{{$val->recommend_login}}</p>@if(Auth::user()->user_id == 1)<p class="client-name">{{ $val->recommend_name }} {{ $val->recommend_last_name }} {{ $val->recommend_middle_name }}</p>@endif</a>
                                                </td>
                                                <td class="arial-font">
                                                    <div>
                                                        {{ $val->country_name_ru }}
                                                    </div>
                                                    <div>
                                                        {{ $val->city_name_ru }}
                                                    </div>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->user_id }}','speaker')">
                                                        <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                                    </a>
                                                </td>
                                            </tr>

                                        @endforeach

                                        </tbody>

                                    </table>
                                </form>
                            </div>

                        </div>
                    </div>


                    <div style="text-align: center">
                        {{ $row->row->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection