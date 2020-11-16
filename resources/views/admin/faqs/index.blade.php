@extends('admin.layout.layout')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a class="menu-tab active-page" href="/admin/faq">Все вопросы</a>
                    </h3>
                    <div style="float: right;">
                        <a href="/admin/faq/create">
                            <button class="btn btn-primary box-add-btn">Добавить вопросы</button>
                        </a>
                    </div>
                    <div class="clear-float"></div>
                </div>
                <div class="box-body">
                    <table id="packet_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th>Вопрос</th>
                            <th>Ответ</th>
                            <th>Статус</th>
                            <th>Дата создание</th>
                            <th>Дата редактирование</th>

                            <th style="width: 15px"></th>
                            <th style="width: 15px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($faqs as $faq)
                            <tr>
                                <td>{{ $faq->id }}</td>
                                <td><p>{{ $faq->question }}</p></td>
                                <td><p>{{ $faq->answer }}</p></td>
                                <td><span class="badge"
                                          style="background-color: {{ $faq->is_active ?  'green': 'red' }};">{{ $faq->is_active ?  'Активный': 'Не активный' }}</span>
                                </td>
                                <td>{{ $faq->created_at}}</td>
                                <td>{{ $faq->updated_at}}</td>
                                <td style="text-align: center">
                                    <a href="/admin/faq/{{ $faq->id }}/edit">
                                        <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)"
                                       onclick="delItem(this,'{{ $faq->id }}','faq')">
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