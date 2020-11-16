@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h1 class="box-title main-title">
                        {{$title}}
                    </h1>
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
                                        <th style="width: 15px">Аватар</th>
                                        <th>Пользователь</th>
                                        <th>Спонсор</th>
                                        <th>Email / Телефон</th>
                                        <th>Объем</th>
                                        <th>Баланс</th>
                                        <th>Подробнее</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <tr>
                                        <td></td>
                                        <td>

                                        </td>
                                        <td>
                                            <form>
                                                <input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск">
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <input value="{{$request->sponsor_name}}" type="text" class="form-control" name="sponsor_name" placeholder="Поиск">
                                            </form>
                                        </td>
                                        <td></td>

                                        <td></td>
                                        <td></td>
                                        <td>

                                        </td>

                                    </tr>

                                    @foreach($row->row as $key => $val)

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
                                                <a class="main-label" href="/admin/profile/{{$val->user_id}}" target="_blank"><p class="login">{{$val->login}}</p><p class="client-name">{{ $val->name }} {{ $val->last_name }} {{ $val->middle_name }}</p>@if($val->is_activated == 0) <p style="color: red">Не активирован</p> @endif</a>
                                            </td>
                                            <td class="arial-font">
                                                <a class="main-label" href="/admin/profile/{{$val->recommend_id}}" target="_blank"><p class="login">{{$val->recommend_login}}</p><p class="client-name">{{ $val->recommend_name }} {{ $val->recommend_last_name }} {{ $val->recommend_middle_name }}</p></a>
                                            </td>
                                            <td class="arial-font">
                                                <div>
                                                    {{ $val->email }} </br>
                                                    {{ $val->phone }}
                                                </div>
                                            </td>
                                            <td class="arial-font">
                                                <?php
                                                $lo_profit = \App\Models\UserPacket::where('is_active',1)
                                                        ->where('user_id',$val->user_id)
                                                        ->sum('packet_price');
                                                ?>
                                                <div>
                                                    <span style="font-weight: 900">ЛО: {{ $lo_profit }} $ ({{round($lo_profit * \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}тг)</span>
                                                </div>
                                                <div>
                                                    <span style="font-weight: 900">ЛКО: {{ $val->left_child_profit }} PV </span>
                                                    <span style="font-weight: 900">ПКО: {{ $val->right_child_profit }} PV</span>
                                                </div>
                                            </td>
                                            <td class="arial-font">
                                                <div>
                                                    <span style="font-weight: 900">{{ $val->user_money }} $ ({{round($val->user_money * \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}тг)</span>
                                                </div>
                                            </td>
                                            <td class="arial-font">
                                                <a href="/admin/operation?user_id={{$val->user_id}}" target="_blank" style="text-decoration: underline">Подробнее</a>
                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>


                    <div style="text-align: center">
                        {{ $row->row->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection