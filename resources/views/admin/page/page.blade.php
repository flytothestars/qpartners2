@extends('admin.layout.layout')

@section('content')

<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title box-title-first">
            <a href="/admin/page<?php if(isset($_GET['parent_id']))echo '?parent_id='.$_GET['parent_id'];?>" class="menu-tab @if(!isset($request->active) || $request->active == '1') active-page @endif">Активные тексты</a>
          </h3>
          <h3 class="box-title box-title-second" >
            <a href="/admin/page?active=0<?php if(isset($_GET['parent_id']))echo '&parent_id='.$_GET['parent_id'];?>" class="menu-tab @if($request->active == '0') active-page @endif">Неактивные тексты</a>
          </h3>
          <a href="/admin/page/create<?php if(isset($_GET['parent_id']))echo '?parent_id='.$_GET['parent_id'];?>" style="float: right">
             <button class="btn btn-primary box-add-btn">Добавить текст</button>
          </a>
          @if(isset($_GET['parent_id']))
            <?php $parent = \App\Models\Speciality::where('page_id',$_GET['parent_id'])->first();
            ?>

            @if($parent->parent_id != null)

                <a href="/admin/page?parent_id=<?=$parent->parent_id;?>" style="float: right;  margin-right: 10px">
                    <button class="btn btn-block btn-success" style="margin-bottom: 10px;">Назад</button>
                </a>

            @else

                <a href="/admin/page" style="float: right;  margin-right: 10px">
                    <button class="btn btn-block btn-success" style="margin-bottom: 10px;">Назад</button>
                </a>

            @endif

          @endif
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

                @if($request->active == '0')

                    <h4 class="box-title box-edit-click">
                        <a href="javascript:void(0)" onclick="isShowEnabledAll('page')">Сделать активным отмеченные</a>
                    </h4>

                @else

                    <h4 class="box-title box-edit-click">
                        <a href="javascript:void(0)" onclick="isShowDisabledAll('page')">Сделать неактивным отмеченные</a>
                    </h4>

                @endif


            </div>
            <div style="text-align: right" class="form-group col-md-6" >
                <h4 class="box-title box-delete-click">
                    <a href="javascript:void(0)" onclick="deleteAll('page')">Удалить отмеченные</a>
                </h4>
            </div>
        </div>
        <div class="box-body">
          <table id="page_datatable" class="table table-bordered table-striped">
            <thead>
              <tr style="border: 1px">
                <th style="width: 30px">ID</th>
                <th >Название</th>
              {{--  <th>Уровень иерархии</th>--}}
                <th style="width: 15px"></th>
                <th style="width: 15px"></th>
                <th class="no-sort" style="width: 0px; text-align: center; padding-right: 16px; padding-left: 14px;" >
                    <input onclick="selectAllCheckbox(this)" style="font-size: 15px" type="checkbox" value="1"/>
                </th>
              </tr>
            </thead>

            <tbody>

                  @foreach($row as $key => $val)

                     <tr>
                        <td> {{ $val['page_id']}}</td>
                        <td>
                           {{-- <a class="object-name" href="/admin/page?parent_id={{$val->page_id}}">--}}
                                {{ $val['page_name_ru']}}
                           {{-- </a>--}}
                        </td>
                        {{-- <td>
                             {{ $val['parent_level']}}
                         </td>--}}
                        <td style="text-align: center">
                            <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->page_id }}','page')">
                                <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                            </a>
                        </td>
                        <td style="text-align: center">
                            <a href="/admin/page/{{ $val->page_id }}/edit">
                                <li class="fa fa-pencil" style="font-size: 20px;"></li>
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <input class="select-all" style="font-size: 15px" type="checkbox" value="{{$val->page_id}}"/>
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