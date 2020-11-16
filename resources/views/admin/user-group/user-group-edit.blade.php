@extends('admin.layout.layout')

@section('content')

    <section class="content-header">
        <h1>
            {{ $title }}
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8" style="padding-left: 0px">
                    <div class="box box-primary">
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        @if($row->user_group_id > 0)
                            <form action="/admin/user-group/{{$row->user_group_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/user-group" method="POST">
                                        @endif
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="user_group_id" value="{{ $row->user_group_id }}">
                                        <input type="hidden" value="@if(isset($_GET['group_id'])){{$_GET['group_id']}}@endif" name="group_id">
                                        <input type="hidden" value="{{ $row->avatar }}" name="avatar" class="image-name">

                                        <div class="box-body">
                                            <div class="form-group"  >
                                                <label>Пользователи</label>
                                                <select name="user_id" data-placeholder="Выберите" class="form-control selectpicker" data-live-search="true">

                                                    @foreach($users_row as $item)
                                                        <option <?php if($row->user_id == $item->user_id) echo 'selected '; ?> value="{{$item->user_id}}">{{$item['name']}} {{$item['last_name']}} {{$item['middle_name']}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group"  >
                                                <label>Фонд</label>
                                                <select name="group_id" data-placeholder="Выберите" class="form-control selectpicker" data-live-search="true">

                                                    @foreach($group_row as $item)
                                                        <option <?php if($row->group_id == $item->group_id) echo 'selected '; ?> value="{{$item->group_id}}">{{$item['group_name_ru']}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Активный</label>
                                                <select name="is_active" data-placeholder="Выберите" class="form-control" data-live-search="true">

                                                    <option @if($row->is_active == 0) selected="selected" @endif value="0">Нет</option>
                                                    <option @if($row->is_active == 1) selected="selected" @endif value="1">Да</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                        </div>
                                    </form>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection

