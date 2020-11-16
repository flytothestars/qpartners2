@extends('admin.layout.layout')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a class="menu-tab active-page" href="/admin/category">Все категорий</a>
                        <a class="menu-tab active-page" href="/admin/product">Все товары</a>
                        <a class="menu-tab active-page" href="/admin/brand">Все бренды</a>
                    </h3>
                    <div style="float: right;">
                        <a href="/admin/product/create">
                            <button class="btn btn-primary box-add-btn">Добавить товар</button>
                        </a>
                        <a href="/admin/category/create">
                            <button class="btn btn-success box-add-btn">Добавить категорию</button>
                        </a>
                        <a href="/admin/brand/create">
                            <button class="btn btn-warning box-add-btn">Добавить бренд</button>
                        </a>
                    </div>
                    <div class="clear-float"></div>
                </div>
                <div class="box-body">
                    <table id="packet_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Показывается на главной странице</th>
                            <th>Изображение</th>
                            <th>Дата создание</th>
                            <th>Дата редактирование</th>

                            <th style="width: 15px"></th>
                            <th style="width: 15px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->description }}</td>
                                <td><span class="badge"
                                          style="background-color: {{ $brand->is_show ?  'green': 'red' }};">{{ $brand->is_show ?  'Да': 'Нет' }}</span>
                                </td>
                                <td><img src="{{$brand->image}}" style="height: 60px; width: 60px;" alt=""></td>
                                <td>{{ $brand->created_at}}</td>
                                <td>{{ $brand->updated_at}}</td>
                                <td style="text-align: center">
                                    <a href="/admin/brand/{{ $brand->id }}/edit">
                                        <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)"
                                       onclick="delItem(this,'{{ $brand->id }}','brand')">
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