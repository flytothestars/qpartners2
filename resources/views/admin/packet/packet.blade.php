@extends('admin.layout.layout')

@section('content')

<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title box-title-first">
            <a class="menu-tab @if(!isset($request->active) || $request->active == '1') active-page @endif">Активные пакеты</a>
          </h3>
          <div class="clear-float"></div>
        </div>
        <div class="box-body">
          <table id="packet_datatable" class="table table-bordered table-striped">
            <thead>
              <tr style="border: 1px">
                <th style="width: 30px">№</th>
                <th></th>
                <th>Название</th>
                <th>Доля</th>
                <th>Услуга</th>
                <th>Товар</th>
                <th style="width: 15px"></th>
              </tr>
            </thead>

            <tbody>

                  @foreach($row as $key => $val)

                     <tr>
                        <td> {{ $key + 1 }}</td>
                         <td>
                             <div class="object-image">
                                 <a class="fancybox" href="{{$val->packet_image}}">
                                     <img src="{{$val->packet_image}}">
                                 </a>
                             </div>
                             <div class="clear-float"></div>
                         </td>
                        <td>
                            {{ $val['packet_name_ru']}}
                        </td>
                        <td>
                            {{ $val['packet_share']}}
                        </td>
                         <td>
                            {{ $val['packet_lection']}}
                        </td>
                         <td>
                            {{ $val['packet_thing']}}
                        </td>
                        <td style="text-align: center">
                            <a href="/admin/packet-item/{{ $val->packet_id }}/edit">
                                <li class="fa fa-pencil" style="font-size: 20px;"></li>
                            </a>
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