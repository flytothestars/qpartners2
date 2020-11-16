<?php
preg_match('/([a-z]*)@/i', $request->route()->getActionName(), $matches);
$controllerName = $matches[1];

?>
@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a href="/admin/news"
                           class="menu-tab @if(($controllerName != 'NewsCategoryController') && !isset($request->active) || $request->active == '1') active-page @endif">Активные
                            новости</a>
                    </h3>
                    <h3 class="box-title box-title-second">
                        <a href="/admin/news?active=0"
                           class="menu-tab @if(($controllerName != 'NewsCategoryController') && $request->active == '0') active-page @endif">Неактивные
                            новости</a>
                    </h3>
                    <h3 class="box-title box-title-second" style="margin-left: 10px;">
                        <a href="/admin/news-category"
                           class="menu-tab @if($controllerName == 'NewsCategoryController') active-page @endif">Категория
                            новостей</a>
                    </h3>
                    <a href="/admin/news/create<?php if (isset($_GET['parent_id'])) echo '?parent_id=' . $_GET['parent_id'];?>"
                       style="float: right">
                        <button class="btn btn-primary box-add-btn">Добавить новость</button>
                    </a>

                    <a style="float: right;margin-right: 10px;" class="btn btn-primary"
                       href="/admin/news-category/create">Добавить ктегорию новостей</a>

                    <div class="clear-float"></div>
                    <div class="form-group col-md-3">
                        <label>Поиск</label>
                        <input id="search_word" value="{{$request->search}}" type="text" class="form-control"
                               name="search_word" placeholder="Введите">
                    </div>
                    <div class="form-group col-md-3 search-btn">
                        <a href="javascript:void(0)" onclick="searchBySort()">
                            <button type="button" class="btn btn-block btn-success">Поиск</button>
                        </a>
                    </div>
                </div>
                <div>
                    <div style="text-align: left" class="form-group col-md-6">

                        @if($request->active == '0')

                            <h4 class="box-title box-edit-click">
                                <a href="javascript:void(0)" onclick="isShowEnabledAll('news')">Сделать активным
                                    отмеченные</a>
                            </h4>

                        @else

                            <h4 class="box-title box-edit-click">
                                <a href="javascript:void(0)" onclick="isShowDisabledAll('news')">Сделать неактивным
                                    отмеченные</a>
                            </h4>

                        @endif


                    </div>
                    <div style="text-align: right" class="form-group col-md-6">
                        <h4 class="box-title box-delete-click">
                            <a href="javascript:void(0)" onclick="deleteAll('news')">Удалить отмеченные</a>
                        </h4>
                    </div>
                </div>
                <div class="box-body">
                    <table id="news_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th>Название</th>
                            <th style="width: 120px">Дата</th>
                            <th style="width: 15px"></th>
                            <th style="width: 15px"></th>
                            <th class="no-sort"
                                style="width: 0px; text-align: center; padding-right: 16px; padding-left: 14px;">
                                <input onclick="selectAllCheckbox(this)" style="font-size: 15px" type="checkbox"
                                       value="1"/>
                            </th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($row as $key => $val)

                            <tr>
                                <td> {{ $key + 1 }}</td>
                                <td>
                                    <a target="_blank" style="text-decoration: underline"
                                       href="/news/{{\App\Http\Helpers::getTranslatedSlugRu($val->news_name_ru)}}-u{{$val->news_id}}">
                                        {{ $val['news_name_ru']}}
                                    </a>
                                </td>
                                <td>
                                    {{ $val->date }}
                                </td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->news_id }}','news')">
                                        <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center">
                                    <a href="/admin/news/{{ $val->news_id }}/edit">
                                        <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <input class="select-all" style="font-size: 15px" type="checkbox"
                                           value="{{$val->news_id}}"/>
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