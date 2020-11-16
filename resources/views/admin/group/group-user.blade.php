@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a href="/admin/user-group" class="menu-tab">Участники</a>
                    </h3>
                    @if(Auth::user()->role_id == 1)
                        <a href="/admin/user-group/create" style="float: right">
                            <button class="btn btn-primary box-add-btn">Добавить участника</button>
                        </a>
                    @endif
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
                                        <th>Участник</th>
                                        <th>Фонд</th>
                                        <th>Статус активации</th>

                                        @if(Auth::user()->role_id == 1)
                                            <th style="width: 20px"></th>
                                            <th style="width: 20px"></th>
                                        @endif
                                    </tr>
                                    </thead>

                                    <tbody>


                                    @foreach($group_users as $key => $val)

                                        <tr>
                                            <td> {{ $key + 1 }}</td>
                                            <td class="arial-font">
                                                <strong>{{ $val->name }}</strong>
                                                <div>
                                                    {{ $val->email }} </br>
                                                    {{ $val->phone }}
                                                </div>
                                            </td>
                                            <td class="arial-font">
                                                {{ $val->group_name_ru }}
                                            </td>
                                            <td class="arial-font">
                                                @if($val->is_active == 1)
                                                    <strong style="color: green">Активный</strong>
                                                @else
                                                    <strong style="color: red">Красный</strong>
                                                @endif
                                            </td>

                                            @if(Auth::user()->role_id == 1)

                                                <td style="text-align: center">
                                                    <a href="/admin/user-group/{{ $val->user_group_id }}/edit">
                                                        <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                                    </a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->user_group_id }}','user-group')">
                                                        <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                                    </a>
                                                </td>

                                            @endif

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