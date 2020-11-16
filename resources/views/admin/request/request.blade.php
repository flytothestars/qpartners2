@extends('admin.layout.layout')

@section('content')

<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title box-title-first">
            <a class="menu-tab active-page">Запросы о снятии денег</a>
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
                <th>ИИН</th>
                <th>Сумма</th>
                <th>Комиссия</th>
                <th style="width: 120px">Дата</th>
                  <th>Коммент</th>
                  <th style="width: 120px"></th>
              </tr>
            </thead>

            <tbody>

            <tr>
                <td></td>
                <td></td>
                <td><form><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск">  </form></td>
                <td></td>
                <td></td>
                <td></td>
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
                            <p style="margin: 0px"><b>ИИН: </b>{{$val->iin}}</p>
                            <p style="margin: 0px"><b>БАНК: </b>{{$val->bank_name}}</p>
                            <p style="margin: 0px"><b>КАРТОЧКА: </b>{{$val->card_number}}</p>
                         </td>
                         <td>
                             {{$val->money*0.9}} $ ({{round($val->money *0.9* \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}тг)
                         </td>
                         <td>
                             {{$val->money*0.1}} $ ({{round($val->money *0.1* \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}тг)
                         </td>
                        <td>
                            {{ $val->date }}
                        </td>
                         <td>
                             {{ $val->comment }}
                         </td>
                         <td style="text-align: center">
                             <button class="btn btn-block btn-success btn-sm" onclick="acceptUserRequest(this,'{{ $val->user_request_id }}')">Принять</button>
                             <button class="btn btn-block btn-error btn-sm" onclick="deleteUserRequest(this,'{{ $val->user_request_id }}')" style="background-color: rgb(255, 88, 83);">Удалить</button>
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