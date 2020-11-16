<?php

use App\Admin\SocialNetwork;

$tab = $request->input('category_type');
$administrationSocialNetworks = SocialNetwork::getSocialNetworks($administration->id, SocialNetwork::ADMINISTRATION_PERSON);

?>
@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a href="/admin/about?category_type=guide"
                           class="menu-tab @if($tab == 'guide') active-page @endif ">
                            Руководство
                        </a>
                    </h3>
                    <h3 class="box-title box-title-first">
                        <a href="/admin/about?category_type=administration"
                           class="menu-tab  @if($tab == 'administration') active-page @endif ">
                            Администрация компании
                        </a>
                    </h3>
                    <h3 class="box-title box-title-first">
                        <a href="/admin/about?category_type=leadership_advice"
                           class="menu-tab @if($tab == 'leaders') active-page @endif">
                            Лидеры компании
                        </a>
                    </h3>
                    <div class="clear-float"></div>
                </div>
                <div class="box-body">
                    <table id="about_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th>Загаловок</th>
                            <th>Текст</th>
                            <th style="width: 100px;">Ссылки на социальные сети</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> {{ $administration->id }}</td>
                            <td> {{ $administration->title }}</td>
                            <td>{{$administration->text_body}}</td>
                            <td>
                                <ul style="list-style: none;margin: 0;padding: 0; width: 120px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                    @foreach($administrationSocialNetworks as $socialNetwork)
                                        <li>
                                            <span style="white-space: nowrap;">
                                                <i style="color: purple;" class="{{$socialNetwork->fa_a_symbol}}"></i>&nbsp;
                                                {{!empty($socialNetwork->url)?$socialNetwork->url:'Не указано'  }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="/admin/about/{{$administration->id}}/edit?category_type=administration">
                                    <i style="color: blue;cursor: pointer;" class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-body">
                    <h3 style="float: left;" class="box-title box-title-first">
                        Администраторы
                    </h3>
                    <a href="/admin/about/create?category_type=administration_persons"
                       style="float: right">
                        <button class="btn btn-primary box-add-btn">Добавить</button>
                    </a>
                    <table id="about_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>ФИО</td>
                            <td>Должность</td>
                            <td>Изображение</td>
                            <td></td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($administration_persons as $person)
                            <tr>
                                <td>{{$person->full_name}}</td>
                                <td>{{$person->responsibility}}</td>
                                <td>
                                    <div style="
                                            width: 200px;
                                            height: 200px;
                                            background-image: url('{{$person->image}}');
                                            background-position: center;
                                            background-repeat: no-repeat;
                                            background-size: contain;
                                            ">

                                    </div>
                                </td>
                                <td>
                                    <a href="/admin/about/{{$person->id}}/edit?category_type=administration_persons">
                                        <i style="color: blue;cursor: pointer;" class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ url('/admin/about/'. $person->id).'?category_type=administration_persons' }}"
                                          method="POST">
                                        {{Form::hidden('_method', 'delete')}}
                                        {{Form::token()}}
                                        <button type="submit" style="background-color: transparent;border: none;">
                                            <i style="color: red;" class="fa fa-trash"></i>
                                        </button>
                                    </form>
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
