@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a href="/admin/group" class="menu-tab">Фонды</a>
                    </h3>
                    @if(Auth::user()->role_id == 1)
                        <a href="/admin/group/create" style="float: right">
                            <button class="btn btn-primary box-add-btn">Добавить фонд</button>
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
                                        <th>Наименование</th>
                                        <th>Максимальное количество людей</th>
                                        <th>Участники</th>

                                        @if(Auth::user()->role_id == 1)
                                            <th style="width: 20px"></th>
                                            <th style="width: 20px"></th>
                                        @endif
                                    </tr>
                                    </thead>

                                    <tbody>


                                    @foreach($groups as $key => $val)

                                        <tr>
                                            <td> {{ $key + 1 }}</td>
                                            <td class="arial-font">
                                                {{ $val->group_name_ru }}
                                            </td>
                                            <td class="arial-font">
                                                {{ $val->max_user_count }}
                                            </td>
                                            <td class="arial-font">
                                                <a href="/admin/user-group?group_id={{$val->group_id}}" target="_blank">
                                                    Посмотреть список
                                                </a>
                                            </td>

                                            @if(Auth::user()->role_id == 1)

                                                <td style="text-align: center">
                                                    <a href="/admin/group/{{ $val->group_id }}/edit">
                                                        <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                                    </a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->group_id }}','group')">
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