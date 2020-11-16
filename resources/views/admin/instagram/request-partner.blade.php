@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a class="menu-tab  active-page">Мои подписчики в инстаграме</a>
                    </h3>
                    <div class="clear-float"></div>
                </div>
                <div class="box-body">

                    <div class="nav-tabs-custom">

                        <div class="tab-content" >
                            <div>

                                <table id="news_datatable" class="table table-bordered table-striped table-css">
                                    <thead>
                                    <tr>
                                        <th style="width: 30px">№</th>
                                        <th style="width: 20px">Аватар</th>
                                        <th>Партнер</th>
                                        <th>Инстаграм</th>
                                        <th>Действие</th>
                                        {{--<th style="width: 20px"></th>
                                        <th style="width: 20px"></th>--}}
                                    </tr>
                                    </thead>

                                    <tbody>

                                    {{--<tr>
                                        <td></td>
                                        <td><input type="hidden" value="1" name="level"></td>
                                        <td><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск"></td>
                                        <td><input value="{{$request->sponsor_name}}" type="text" class="form-control" name="sponsor_name" placeholder="Поиск"></td>
                                        <td></td>
                                        <td></td>
                                        <td><input value="{{$request->city_name}}" type="text" class="form-control" name="city_name" placeholder="Поиск"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>--}}

                                    @foreach($partners as $key => $val)

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

                                                <?php $val->instagram = str_replace(['https://instagram.com/','https://instagram.com','instagram.com/','instagram.com'],'',$val->instagram); ?>

                                                <div>
                                                    <a style="text-decoration: underline" href="https://www.instagram.com/{{ $val->instagram }}" target="_blank">
                                                        {{ $val->instagram }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="arial-font">
                                                <div>

                                                   @if($val->is_success == 0)
                                                        <button onclick="acceptInstagram(this,'{{$val->user_subscribe_id}}')" class="btn btn-block btn-success btn-sm" style="background-color: #3C8DBC !important;">Принять</button>
                                                    @else
                                                        <button onclick="rejectInstagram(this,'{{$val->user_subscribe_id}}')" class="btn btn-block btn-success btn-sm" style="background-color: #FF0C1A !important;">Отклонить</button>
                                                    @endif

                                                </div>
                                            </td>
                                            {{-- <td style="text-align: center">
                                                 <a href="/admin/office/user/{{ $val->user_id }}">
                                                     <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                                 </a>
                                             </td>
                                             <td style="text-align: center">
                                                 <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->user_id }}','office')">
                                                     <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                                 </a>
                                             </td>--}}
                                        </tr>

                                    @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection