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
                        @if($row->group_id > 0)
                            <form action="/admin/group/{{$row->group_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/group" method="POST">
                                        @endif
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="group_id" value="{{ $row->group_id }}">
                                        <input type="hidden" value="@if(isset($_GET['parent_id'])){{$_GET['parent_id']}}@endif" name="parent_id">
                                        <input type="hidden" value="{{ $row->avatar }}" name="avatar" class="image-name">

                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Наименование</label>
                                                <input value="{{ $row->group_name_ru }}" type="text" class="form-control" name="group_name_ru" placeholder="Введите">
                                            </div>
                                            <div class="form-group">
                                                <label>Максимальное количество людей</label>
                                                <input value="{{ $row->max_user_count }}" type="text" class="form-control" name="max_user_count" placeholder="Введите">
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

