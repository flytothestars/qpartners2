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
                                <th>Дата покупки</th>
                                <th>Город</th>
                            </tr>
                            </thead>

                            <tbody>

                            @if(Auth::user()->role_id == 1)
                                <tr>
                                        <td></td>
                                        <td><input type="hidden" value="1" name="level"></td>
                                        <td><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск"></td>
                                        <td><input value="{{$request->sponsor_name}}" type="text" class="form-control" name="sponsor_name" placeholder="Поиск"></td>
                                        <td></td>
                                        <td><input value="{{$request->city_name}}" type="text" class="form-control" name="city_name" placeholder="Поиск"></td>
                                </tr>
                            @endif

                            @foreach($row->row as $key => $val)

                                <tr>
                                    <td> {{ $key + 1 }}</td>
                                    <td>
                                        <div class="object-image client-image">
                                            <a  @if(Auth::user()->role_id == 1) href="/admin/profile/{{$val->user_id}}" target="_blank" @endif>
                                                <img src="{{$val->avatar}}">
                                            </a>
                                        </div>
                                        <div class="clear-float"></div>
                                    </td>
                                    <td class="arial-font">
                                        <a class="main-label"  @if(Auth::user()->role_id == 1) href="/admin/profile/{{$val->user_id}}" target="_blank" @endif><p class="login">{{$val->login}}</p>@if(Auth::user()->user_id == 1)<p class="client-name">{{ $val->name }} {{ $val->last_name }} {{ $val->middle_name }}</p>@endif</a>
                                    </td>
                                    <td class="arial-font">
                                        <a class="main-label"  @if(Auth::user()->role_id == 1) href="/admin/profile/{{$val->recommend_id}}" target="_blank" @endif><p class="login">{{$val->recommend_login}}</p>@if(Auth::user()->user_id == 1)<p class="client-name">{{ $val->recommend_name }} {{ $val->recommend_last_name }} {{ $val->recommend_middle_name }}</p>@endif</a>
                                    </td>
                                    <td class="arial-font">
                                        <div>
                                            {{ $val->date }}
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