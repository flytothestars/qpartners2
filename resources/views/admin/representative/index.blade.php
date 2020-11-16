<?php

use Illuminate\Support\Arr;

$cities = \App\Models\City::all();
$cities = collect($cities);
$cities = $cities->all();
$cities = Arr::pluck($cities, 'city_name_ru', 'city_id');
?>
@extends('admin.layout.layout')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a class="menu-tab active-page" href="/admin/representative">Все предсатвители</a>
                    </h3>
                    <div style="float: right;">
                        <a href="/admin/representative/create">
                            <button class="btn btn-primary box-add-btn">Добавить представителей</button>
                        </a>
                    </div>
                    <div class="clear-float"></div>
                </div>
                <div class="box-body">
                    <table id="packet_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th>Город</th>
                            <th>Адрес</th>
                            <th>ФИО</th>
                            <th>Номер телефона</th>
                            <th>Whatsapp</th>
                            <th>Instagram</th>
                            <th>Активный</th>
                            <th>Дата создание</th>
                            <th>Дата редактирование</th>

                            <th style="width: 15px"></th>
                            <th style="width: 15px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($representatives as $representative)
                            <tr>
                                <td>{{ $representative->id }}</td>
                                <td><p>{{ $representative->city_id ?  $cities[$representative->city_id] : 'Не указано' }}</p></td>
                                <td><p>{{ $representative->address  }}</p></td>
                                <td><p>{{ $representative->full_name }}</p></td>
                                <td><p>{{ $representative->phone_number }}</p></td>
                                <td><p>{{ $representative->whatsapp }}</p></td>
                                <td><p>{{ $representative->instagram }}</p></td>

                                <td><span class="badge"
                                          style="background-color: {{ $representative->is_active ?  'green': 'red' }};">{{ $representative->is_active ?  'Активный': 'Не активный' }}</span>
                                </td>
                                <td>{{ $representative->created_at}}</td>
                                <td>{{ $representative->updated_at}}</td>
                                <td style="text-align: center">
                                    <a href="/admin/representative/{{ $representative->id }}/edit">
                                        <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)"
                                       onclick="delItem(this,'{{ $representative->id }}','representative')">
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