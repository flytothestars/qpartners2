@extends('admin.layout.layout')

@section('content')

<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title box-title-first">
            <a class="menu-tab active-page">Запросы на пакет</a>
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
                <th>Спонсор</th>
                <th>Пакет</th>
                <th>Подарок</th>
                <th style="width: 120px">Дата</th>
                  <th style="width: 120px">Дата</th>
              </tr>
            </thead>

            <tbody>

            <tr>
                <td></td>
                <td></td>
                <td><form><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск">  </form></td>
                <td><form><input value="{{$request->sponsor_name}}" type="text" class="form-control" name="sponsor_name" placeholder="Поиск"> </form></td>
                <td><form><input value="{{$request->packet_name}}" type="text" class="form-control" name="packet_name" placeholder="Поиск"> </form></td>
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
                             <a class="main-label" href="/admin/profile/{{$val->recommend_id}}" target="_blank"><p class="login">{{$val->recommend_login}}</p>@if(Auth::user()->user_id == 1)<p class="client-name">{{ $val->recommend_name }} {{ $val->recommend_last_name }} {{ $val->recommend_middle_name }}</p>@endif</a>
                         </td>
                         <td>
                             <span class="label" style="font-size:15px; padding:2px 10px; background-color: #{{$val['packet_css_color']}}">{{$val['packet_name_ru']}}</span>
                         </td>
                         <td>
                             @if($val->user_packet_type == 'share')
                                 Доля
                             @elseif($val->user_packet_type == 'item')
                                 {{$val->packet_item}}
                             @elseif($val->user_packet_type == 'service')
                                 {{$val->packet_service}}
                             @endif
                         </td>
                        <td>
                            {{ $val->date }}
                        </td>
                         <td style="text-align: center">
                             @if($val->is_epay == 0)
                                <button class="btn btn-block btn-success btn-sm" onclick="acceptUserPacket(this,'{{ $val->user_packet_id }}')">Принять</button>
                             @else
                                 <button class="btn btn-block btn-success btn-sm">PayBox</button>
                             @endif
                             <button class="btn btn-block btn-error btn-sm" onclick="deleteUserPacket(this,'{{ $val->user_packet_id }}')" style="background-color: rgb(255, 88, 83);">Удалить</button>
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