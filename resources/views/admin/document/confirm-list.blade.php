@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a class="menu-tab active-page">Подтверждение документа</a>
                    </h3>
                    <div class="clear-float"></div>
                </div>

                <div class="box-body">

                    <table id="news_datatable" class="table table-bordered table-striped table-css">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th style="width: 100px">Аватар</th>
                            <th>Партнер</th>
                            <th>Спонсор</th>
                            <th>Список документов</th>
                            <th style="width: 120px">Дата</th>
                            <th style="width: 120px">Дата</th>
                        </tr>
                        </thead>

                        <tbody>

                        <tr>
                            <td></td>
                            <td></td>
                            <td><form><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск">  </form></td>
                            <td><form><input value="{{$request->sponsor_name}}" type="text" class="form-control" name="sponsor_name" placeholder="Поиск"> </form></td>
                            <td><form><input value="{{$request->packet_name}}" type="text" class="form-control" name="packet_name" placeholder="Поиск"> </form></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        @foreach($row as $key => $val)

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
                                <td>
                                    <a class="main-label" href="/admin/document/{{$val->user_id}}" target="_blank" style="text-decoration: underline">Список документов</a>
                                </td>
                                <td>
                                    {{ $val->date }}
                                </td>
                                <td style="text-align: center">
                                    <button class="btn btn-block btn-error btn-sm" onclick="deleteUserDocumentRequest(this,'{{ $val->user_confirm_document_id }}')" style="background-color: rgb(255, 88, 83);">Удалить</button>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                    <div style="text-align: center">
                        {{ $row->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection