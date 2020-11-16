@extends('admin.layout.layout')

@section('content')

<div class="row">
    <div class="col-xs-12">
      <div class="box">
          <div class="box-header">
              <h1 class="box-title main-title">
                  {{$title}}
              </h1>
          </div>

        <div class="box-body">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li @if(!isset($_GET['level']) || $_GET['level'] == 1) class="active" @endif>
                        <a href="#packet1" data-toggle="tab">{{$packet_name}} - 1</a>
                    </li>
                    <li @if(isset($_GET['level']) && $_GET['level'] == 2) class="active" @endif>
                        <a href="#packet2" data-toggle="tab">{{$packet_name}} - 2</a>
                    </li>
                    <li @if(isset($_GET['level']) && $_GET['level'] == 3) class="active" @endif>
                        <a href="#packet3" data-toggle="tab">{{$packet_name}} - 3</a>
                    </li>
                   {{-- <li @if(isset($_GET['level']) && $_GET['level'] == 4) class="active" @endif>
                        <a href="#packet4" data-toggle="tab">{{$packet_name}} - 4</a>
                    </li>--}}
                </ul>
                <div class="tab-content" >
                    <div class="@if(!isset($_GET['level']) || $_GET['level'] == 1) active @endif tab-pane" id="packet1">
                        <table class="table table-bordered table-striped table-css">
                            <thead>
                            <tr>
                                <th style="width: 30px">№</th>
                                <th style="width: 20px">Аватар</th>
                                <th>Пользователь</th>
                                <th>Спонсор</th>
                                <th>Страна/Город</th>
                                <th>Дата регистрации</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($row->first_level_without_queue as $key => $val)

                                @include('admin.world.client-list-without-queue-loop')

                            @endforeach

                            </tbody>

                        </table>

                        <h1 class="box-title main-title">
                            Мировая очередь {{$packet_name}} - 1
                        </h1>

                        <form>
                        <table id="news_datatable" class="table table-bordered table-striped table-css">
                            <thead>
                            <tr>
                                <th style="width: 30px">№</th>
                                <th style="width: 20px">Аватар</th>
                                <th>Пользователь</th>
                                <th>Спонсор</th>
                                <th>Номер в очереди</th>
                                <th>Страна/Город</th>
                            </tr>
                            </thead>

                            <tbody>

                            @if(Auth::user()->role_id == 1)
                                <tr>
                                        <td></td>
                                        <td><input type="hidden" value="1" name="level"></td>
                                        <td><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск"></td>
                                        <td><input value="{{$request->sponsor_name}}" type="text" class="form-control" name="sponsor_name" placeholder="Поиск"></td>
                                        <td><input value="{{$request->queue_now_position}}" type="text" class="form-control" name="queue_now_position" placeholder="Поиск"></td>
                                        <td><input value="{{$request->city_name}}" type="text" class="form-control" name="city_name" placeholder="Поиск"></td>
                                </tr>
                            @endif

                            @foreach($row->first_level as $key => $val)

                                @if(Auth::user()->role_id == 1 || ($row->is_exist_current_user_in_first_level != null && $row->is_exist_current_user_in_first_level->queue_now_position > $val->queue_now_position))

                                    @include('admin.world.client-list-loop')

                                @endif

                            @endforeach

                            @if(isset($row->first_level[0]) && $row->first_level[0]->user_id == Auth::user()->user_id)
                                <?php $val = $row->first_level[0]; ?>

                                @include('admin.world.client-list-loop')

                            @endif

                            </tbody>

                        </table>
                        </form>
                    </div>
                    <div class="@if(isset($_GET['level']) && $_GET['level'] == 2) active @endif tab-pane" id="packet2">
                        <table class="table table-bordered table-striped table-css">
                            <thead>
                            <tr>
                                <th style="width: 30px">№</th>
                                <th style="width: 20px">Аватар</th>
                                <th>Пользователь</th>
                                <th>Спонсор</th>
                                <th>Страна/Город</th>
                                <th>Дата регистрации</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($row->second_level_without_queue as $key => $val)

                                @include('admin.world.client-list-without-queue-loop')

                            @endforeach

                            </tbody>

                        </table>

                        <h1 class="box-title main-title">
                            Мировая очередь {{$packet_name}} - 2
                        </h1>

                        <form>
                            <table id="news_datatable" class="table table-bordered table-striped table-css">
                                <thead>
                                <tr>
                                    <th style="width: 30px">№</th>
                                    <th style="width: 20px">Аватар</th>
                                    <th>Пользователь</th>
                                    <th>Спонсор</th>
                                    <th>Номер в очереди</th>
                                    <th>Страна/Город</th>
                                </tr>
                                </thead>

                                <tbody>

                                @if(Auth::user()->role_id == 1)
                                <tr>
                                    <td></td>
                                    <td><input type="hidden" value="2" name="level"></td>
                                    <td><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск"></td>
                                    <td><input value="{{$request->sponsor_name}}" type="text" class="form-control" name="sponsor_name" placeholder="Поиск"></td>
                                    <td><input value="{{$request->queue_now_position}}" type="text" class="form-control" name="queue_now_position" placeholder="Поиск"></td>
                                    <td><input value="{{$request->city_name}}" type="text" class="form-control" name="city_name" placeholder="Поиск"></td>
                                </tr>
                                @endif

                                @foreach($row->second_level as $key => $val)

                                    @if(Auth::user()->role_id == 1 || ($row->is_exist_current_user_in_second_level != null && $row->is_exist_current_user_in_second_level->queue_now_position > $val->queue_now_position))

                                    @include('admin.world.client-list-loop')

                                    @endif

                                @endforeach

                                @if(isset($row->second_level[0]) && $row->second_level[0]->user_id == Auth::user()->user_id)
                                    <?php $val = $row->second_level[0]; ?>

                                    @include('admin.world.client-list-loop')

                                @endif

                                </tbody>

                            </table>
                        </form>
                    </div>
                    <div class="@if(isset($_GET['level']) && $_GET['level'] == 3) active @endif tab-pane" id="packet3">
                        <table class="table table-bordered table-striped table-css">
                            <thead>
                            <tr>
                                <th style="width: 30px">№</th>
                                <th style="width: 20px">Аватар</th>
                                <th>Пользователь</th>
                                <th>Спонсор</th>
                                <th>Страна/Город</th>
                                <th>Дата регистрации</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($row->third_level_without_queue as $key => $val)

                                @include('admin.world.client-list-without-queue-loop')

                            @endforeach

                            </tbody>

                        </table>

                        <h1 class="box-title main-title">
                            Мировая очередь {{$packet_name}} - 3
                        </h1>

                        <form>
                            <table id="news_datatable" class="table table-bordered table-striped table-css">
                                <thead>
                                <tr>
                                    <th style="width: 30px">№</th>
                                    <th style="width: 20px">Аватар</th>
                                    <th>Пользователь</th>
                                    <th>Спонсор</th>
                                    <th>Номер в очереди</th>
                                    <th>Страна/Город</th>
                                </tr>
                                </thead>

                                <tbody>

                                @if(Auth::user()->role_id == 1)
                                    <tr>
                                        <td></td>
                                        <td><input type="hidden" value="3" name="level"></td>
                                        <td><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск"></td>
                                        <td><input value="{{$request->sponsor_name}}" type="text" class="form-control" name="sponsor_name" placeholder="Поиск"></td>
                                        <td><input value="{{$request->queue_now_position}}" type="text" class="form-control" name="queue_now_position" placeholder="Поиск"></td>
                                        <td><input value="{{$request->city_name}}" type="text" class="form-control" name="city_name" placeholder="Поиск"></td>
                                    </tr>
                                @endif

                                @foreach($row->third_level as $key => $val)

                                    @if(Auth::user()->role_id == 1 || ($row->is_exist_current_user_in_third_level != null && $row->is_exist_current_user_in_third_level->queue_now_position > $val->queue_now_position))

                                    @include('admin.world.client-list-loop')

                                    @endif

                                @endforeach

                                @if(isset($row->third_level[0]) && $row->third_level[0]->user_id == Auth::user()->user_id)
                                    <?php $val = $row->third_level[0]; ?>

                                    @include('admin.world.client-list-loop')

                                @endif

                                </tbody>

                            </table>
                        </form>

                    </div>
                    <div class="@if(isset($_GET['level']) && $_GET['level'] == 4) active @endif tab-pane" id="packet4">
                        <table class="table table-bordered table-striped table-css">
                            <thead>
                            <tr>
                                <th style="width: 30px">№</th>
                                <th style="width: 20px">Аватар</th>
                                <th>Пользователь</th>
                                <th>Спонсор</th>
                                <th>Страна/Город</th>
                                <th>Дата регистрации</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($row->fourth_level_without_queue as $key => $val)

                                @include('admin.world.client-list-without-queue-loop')

                            @endforeach

                            </tbody>

                        </table>

                        <h1 class="box-title main-title">
                            Мировая очередь {{$packet_name}} - 4
                        </h1>

                        <form>
                            <table id="news_datatable" class="table table-bordered table-striped table-css">
                                <thead>
                                <tr>
                                    <th style="width: 30px">№</th>
                                    <th style="width: 20px">Аватар</th>
                                    <th>Пользователь</th>
                                    <th>Спонсор</th>
                                    <th>Номер в очереди</th>
                                    <th>Страна/Город</th>
                                </tr>
                                </thead>

                                <tbody>

                                @if(Auth::user()->role_id == 1)
                                    <tr>
                                        <td></td>
                                        <td><input type="hidden" value="4" name="level"></td>
                                        <td><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск"></td>
                                        <td><input value="{{$request->sponsor_name}}" type="text" class="form-control" name="sponsor_name" placeholder="Поиск"></td>
                                        <td><input value="{{$request->queue_now_position}}" type="text" class="form-control" name="queue_now_position" placeholder="Поиск"></td>
                                        <td><input value="{{$request->city_name}}" type="text" class="form-control" name="city_name" placeholder="Поиск"></td>
                                    </tr>
                                @endif

                                @foreach($row->fourth_level as $key => $val)

                                    @if(Auth::user()->role_id == 1 || ($row->is_exist_current_user_in_fourth_level != null && $row->is_exist_current_user_in_fourth_level->queue_now_position > $val->queue_now_position))

                                    @include('admin.world.client-list-loop')

                                    @endif

                                @endforeach

                                @if(isset($row->fourth_level[0]) && $row->fourth_level[0]->user_id == Auth::user()->user_id)
                                    <?php $val = $row->fourth_level[0]; ?>

                                    @include('admin.world.client-list-loop')

                                @endif

                                </tbody>

                            </table>
                        </form>

                    </div>
                </div>
            </div>

            {{--<div style="text-align: center">
                {{ $row->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
            </div>--}}

        </div>
      </div>
    </div>
    </div>

@endsection