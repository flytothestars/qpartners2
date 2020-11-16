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
                        @if($row->instagram_id > 0)
                            <form action="/admin/instagram/{{$row->instagram_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/instagram" method="POST">
                                        @endif
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="instagram_id" value="{{ $row->instagram_id }}">
                                        <input type="hidden" value="@if(isset($_GET['parent_id'])){{$_GET['parent_id']}}@endif" name="parent_id">
                                        <input type="hidden" value="{{ $row->avatar }}" name="avatar" class="image-name">

                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Имя</label>
                                                <input value="{{ $row->name }}" type="text" class="form-control" name="name" placeholder="Введите">
                                            </div>
                                            <div class="form-group">
                                                <label>Инстаграм</label>
                                                <input value="{{ $row->instagram }}" type="text" class="form-control" name="instagram" placeholder="Введите">
                                            </div>
                                            <div class="form-group">
                                                <label>Тип</label>
                                                <select name="type" data-placeholder="Выберите" class="form-control" data-live-search="true">

                                                    <option @if($row->type == 0) selected="selected" @endif value="0">Корпоративный аккаунт</option>
                                                    <option @if($row->type == 1) selected="selected" @endif value="1">Рекомендуемый аккаунт</option>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Порядковый номер сортировки</label>
                                                <input value="{{ $row->sort_num }}" type="text" class="form-control" name="sort_num" placeholder="Введите">
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                        </div>
                                    </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-primary" style="padding: 30px; text-align: center">
                        <div style="padding: 20px; border: 1px solid #c2e2f0">
                            <img class="image-src" src="{{ $row->avatar }}" style="width: 100%; "/>
                        </div>
                        <div style="background-color: #c2e2f0;height: 40px;margin: 0 auto;width: 2px;"></div>
                        <form id="image_form" enctype="multipart/form-data" method="post" class="image-form">
                            <i class="fa fa-plus"></i>
                            <input id="avatar-file" type="file" onchange="uploadImage()" name="image"/>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

