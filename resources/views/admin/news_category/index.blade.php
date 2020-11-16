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

                </div>
                <div class="box-body">
                    <table id="packet_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Активный</th>
                            <th>Дата создание</th>
                            <th>Дата редактирование</th>

                            <th style="width: 15px"></th>
                            <th style="width: 15px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($news_category as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td><span class="badge"
                                          style="background-color: {{ $category->is_active ?  'green': 'red' }};">{{ $category->is_active ?  'Да': 'Нет' }}</span>
                                </td>
                                <td>{{ $category->created_at}}</td>
                                <td>{{ $category->updated_at}}</td>
                                <td style="text-align: center">
                                    <a href="/admin/news-category/{{ $category->id }}/edit">
                                        <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)"
                                       onclick="delItem(this,'{{ $category->id }}','news-category')">
                                        <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection