@extends('admin.layout.layout')

@section('content')

<div class="row">
    <div class="col-xs-12">
      <div class="box">
          <div class="box-header">
              <h3 class="box-title box-title-first">
                  <a href="/admin/user" class="menu-tab @if(!isset($request->is_ban) ||  $request->is_ban == '0') active-page @endif">Активные пользователи</a>
              </h3>
              <h3 class="box-title box-title-second" >
                  <a href="/admin/user?is_ban=1" class="menu-tab @if($request->is_ban == '1') active-page @endif">Неактивные пользователи</a>
              </h3>
              <a href="/admin/user/create" style="float: right">
                  <button class="btn btn-primary box-add-btn">Добавить администратора</button>
              </a>
              <div class="clear-float"></div>
              <div class="form-group col-md-3" >
                  <label>Поиск</label>
                  <input id="search_word" value="{{$request->search}}" type="text" class="form-control" name="search_word" placeholder="Введите">
              </div>
              <div class="form-group col-md-3 search-btn" >
                  <a href="javascript:void(0)" onclick="searchBySort()">
                      <button type="button" class="btn btn-block btn-success">Поиск</button>
                  </a>
              </div>
          </div>
          <div>
              <div style="text-align: left" class="form-group col-md-6" >

                  @if($request->is_ban == '1')

                      <h4 class="box-title box-edit-click">
                          <a href="javascript:void(0)" onclick="isShowDisabledAll('user')">Разблокировать отмеченные</a>
                      </h4>

                  @else

                      <h4 class="box-title box-edit-click">
                          <a href="javascript:void(0)" onclick="isShowEnabledAll('user')">Заблокировать отмеченные</a>
                      </h4>

                  @endif


              </div>
              <div style="text-align: right" class="form-group col-md-6" >
                  <h4 class="box-title box-delete-click">
                      <a href="javascript:void(0)" onclick="deleteAll('user')">Удалить отмеченные</a>
                  </h4>
              </div>
          </div>
        <div class="box-body">
          <table id="news_datatable" class="table table-bordered table-striped">
            <thead>
              <tr style="border: 1px">
                <th style="width: 30px">№</th>
                <th style="width: 20px">Аватар</th>
                <th>Пользователь</th>
                <th>Email</th>
                <th style="width: 30px"></th>
                <th style="width: 30px"></th>
                <th class="no-sort" style="width: 0px; text-align: center; padding-right: 16px; padding-left: 14px;" >
                  <input onclick="selectAllCheckbox(this)" style="font-size: 15px" type="checkbox" value="1"/>
                </th>
              </tr>
            </thead>

            <tbody>

                  @foreach($row as $key => $val)

                     <tr>
                        <td> {{ $key + 1 }}</td>
                        <td>
                            <div class="object-image">
                                <a class="fancybox" href="{{$val->avatar}}">
                                    <img src="{{$val->avatar}}">
                                </a>
                            </div>
                            <div class="clear-float"></div>
                        </td>
                         <td class="arial-font">
                             <div>
                                 {{ $val->name }}
                             </div>
                         </td>
                        <td class="arial-font">
                            <div>
                                {{ $val->email }}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->user_id }}','user')">
                                <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                            </a>
                        </td>
                        <td style="text-align: center">
                            <a href="/admin/user/{{ $val->user_id }}/edit">
                                <li class="fa fa-pencil" style="font-size: 20px;"></li>
                            </a>
                        </td>
                        <td style="text-align: center;">
                             <input class="select-all" style="font-size: 15px" type="checkbox" value="{{$val->user_id}}"/>
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