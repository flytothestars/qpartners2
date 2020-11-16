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
                                    <form action="/admin/office/user" method="POST">

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="edit_user_id" value="{{ $user_id }}">

                                        <div class="box-body">

                                            {{-- @if($user_id == null) --}}

                                                <div class="form-group"  >
                                                    <label>Директор</label>
                                                    <select name="user_id" data-placeholder="Выберите" class="form-control selectpicker" data-live-search="true">

                                                        @foreach($users_row as $item)
                                                            <option <?php if($row->user_id == $item->user_id) echo 'selected '; ?> value="{{$item->user_id}}">{{$item['name']}} {{$item['last_name']}} {{$item['middle_name']}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                           {{-- @else

                                                <input type="hidden" name="user_id" value="{{ $user_id }}">

                                            @endif --}}




                                            <div class="form-group">
                                                <label>Офис</label>
                                                <input value="{{ $row->office_name }}" type="text" class="form-control" name="office_name" placeholder="Введите">
                                            </div>

                                            <div class="form-group">
                                                <label>Лимит дохода</label>
                                                <input value="{{ $row->office_limit }}" type="text" class="form-control" name="office_limit" placeholder="Введите">
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

