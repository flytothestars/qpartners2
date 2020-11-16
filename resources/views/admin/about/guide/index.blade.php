<?php
$tab = $request->input('category_type');
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
                            <th>ФИО автора</th>
                            <th>Должность автора</th>
                            <th style="width: 100px;">Ссылки на социальные сети</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($guide as $key => $val)
                            <tr>
                                <td> {{ $val->id }}</td>
                                <td> {{ $val->title }}</td>
                                <td> {{ $val->text_body }}</td>
                                <td> {{ $val->author_full_name }}</td>
                                <td> {{ $val->author_responsibility }}</td>

                                <td>
                                    <ul style="list-style: none;margin: 0;padding: 0; width: 120px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                        <li>
                                            <span style="white-space: nowrap;">
                                                <i style="color: purple;" class="fa fa-instagram"></i>&nbsp;
                                                {{!empty($val->author_instagram_link)?$val->author_instagram_link:'Не указано'  }}
                                            </span>
                                        </li>
                                        <li>
                                            <span style="white-space: nowrap;">
                                                <i style="color: #0d70b7;" class="fa fa-facebook"></i>&nbsp;
                                                {{!empty($val->author_facebook_link)?$val->author_facebook_link:'Не указано'  }}
                                            </span>
                                        </li>
                                        <li>
                                            <span style="white-space: nowrap;">
                                                <i style="color: lightgreen;" class="fa fa-whatsapp"></i>&nbsp;
                                                {{!empty($val->author_whatsapp_link)?$val->author_whatsapp_link:'Не указано'  }}
                                            </span>
                                        </li>
                                        <li>
                                            <span style="white-space: nowrap;">
                                                <i style="color: lightseagreen;" class="fa fa-twitter"></i>&nbsp;
                                                {{!empty($val->author_twitter_link)?$val->author_twitter_link:'Не указано'  }}
                                            </span>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <a href="/admin/about/{{$val->id}}/edit?category_type=guide">
                                        <i style="color: blue;cursor: pointer;" class="fa fa-edit"></i>
                                    </a>
                                </td>
{{--                                <td>--}}
{{--                                    <form action="{{ url('/admin/about/'. $val->id).'?category_type=guide' }}"--}}
{{--                                          method="POST">--}}
{{--                                        {{Form::hidden('_method', 'delete')}}--}}
{{--                                        {{Form::token()}}--}}
{{--                                        <button type="submit" style="background-color: transparent;border: none;">--}}
{{--                                            <i style="color: red;" class="fa fa-trash"></i>--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection