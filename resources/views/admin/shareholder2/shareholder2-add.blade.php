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
                        <form action="/admin/shareholder2/user" method="POST">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="box-body">
                                <div class="form-group">
                                    <label>Пользователь</label>
                                    <select name="user_id" data-placeholder="Выберите" class="form-control selectpicker" data-live-search="true">

                                        @foreach($users_row as $item)
                                            <option <?php if($row->user_id == $item->user_id) echo 'selected '; ?> value="{{$item->user_id}}">{{$item['name']}} {{$item['last_name']}} {{$item['middle_name']}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Доля</label>
                                    <input value="{{ $row->user_share }}" type="text" class="form-control" name="user_share" placeholder="Введите">
                                </div>
                                <div class="form-group">
                                    <label>Комментарий</label>
                                    <textarea name="operation_comment" class="form-control"><?=$row->operation_comment?></textarea>
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

