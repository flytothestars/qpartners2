@extends('admin.layout.layout')

@section('content')

<div class="row">
    <div class="col-xs-12">
      <div class="box">


        <div class="box-body">
            <div class="box-header">
                <h1 class="box-title main-title">
                    {{$title}}
                </h1>
            </div>
            <div class="nav-tabs-custom">

                <div class="tab-content" >
                    <div>
                        <form class="submit_form">
                        <table id="news_datatable" class="table table-bordered table-striped table-css">
                            <thead>
                            <tr>
                                <th style="width: 30px">№</th>
                                <th>Пользователь</th>
                                <th>Отправитель</th>
                                <th style="width: 150px">Тип операция</th>
                                <th style="width: 100px">Операция</th>
                                <th>Количество</th>
                                <th>Комментарий</th>
                                <th>Дата</th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr style="background-color: #ebebeb">
                                <td></td>
                                <td><input value="{{$request->recipient_name}}" type="text" class="form-control" name="recipient_name" placeholder="Поиск"></td>
                                <td><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск"></td>
                                <td><input value="{{$request->operation_type}}" type="text" class="form-control" name="operation_type" placeholder="Поиск"></td>
                                <td><input value="{{$request->operation}}" type="text" class="form-control" name="operation" placeholder="Поиск"></td>
                                <td colspan="3" style="text-align: center">
                                    от <input style="width: 35%; display: inline-block" value="{{$request->date_from}}" type="text" class="form-control datetimepicker-input date-submit" name="date_from" placeholder="Дата">
                                    - до <input style="width: 35%; display: inline-block" value="{{$request->date_to}}" type="text" class="form-control datetimepicker-input date-submit" name="date_to" placeholder="Дата">
                                    <input type="submit" value="ОК" style="padding: 5px 7px">
                                </td>
                            </tr>
                            @foreach($row as $key => $val)

                                <tr @if($val->operation_type_id == 10) style="background-color: #91ff91 !important;" @elseif($val->operation_type_id == 33) style="background-color: yellow !important;" @endif>
                                    <td> {{ $key + 1 }}</td>
                                    <td class="arial-font">
                                        <a class="main-label" @if(Auth::user()->role_id == 1) href="/admin/profile/{{$val->recipient_id}}" target="_blank" @endif><p class="login">{{$val->recipient_login}}</p><p class="client-name">{{ $val->recipient_name }} {{ $val->recipient_last_name }} {{ $val->recipient_middle_name }}</p></a>
                                    </td>
                                    <td class="arial-font">
                                        <a class="main-label" @if(Auth::user()->role_id == 1) href="/admin/profile/{{$val->user_id}}" target="_blank" @endif><p class="login">{{$val->login}}</p><p class="client-name">{{ $val->name }} {{ $val->last_name }} {{ $val->middle_name }}</p></a>
                                    </td>
                                    <td class="arial-font">
                                        {{ $val->operation_type_name_ru }} @if($val->operation_type_id == 9) "{{$val->fond_name_ru}}" @endif
                                    </td>
                                    <td class="arial-font">
                                        {{ $val->operation_name_ru }}
                                    </td>
                                    <td class="arial-font">
                                        @if($val->operation_type_id == 2)
                                            {{ $val->money }} доля
                                        @else
                                            {{ round($val->money,2) }} $ ({{round($val->money * \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}тг)
                                        @endif
                                    </td>
                                    <td class="arial-font">
                                        {{ $val->operation_comment }}
                                    </td>
                                    <td class="arial-font">
                                        {{ $val->date }}
                                    </td>
                                </tr>

                            @endforeach

                                {{-- <tr>
                                    <td colspan="5" style="text-align: right"><b>Общая сумма:</b> </td>
                                    <td colspan="1"><b>{{round($row_sum,2)}} $ ({{round($row_sum * \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}тг)</b></td>
                                    <td colspan="2"></td>
                                </tr> --}}
                            </tbody>

                        </table>
                        </form>
                    </div>

                </div>
            </div>


            <div style="text-align: center">
                {{ $row->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
            </div>

        </div>
      </div>
    </div>
    </div>

@endsection