<form action="/admin/profile/password/edit" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <input type="hidden" value="{{$row->user_id}}" name="user_id"/>
        <div class="form-group">
            <label>Старый пароль</label>
            <input readonly value="{{$row->password_original}}" type="text" class="form-control" name="password_original" placeholder="Неизвестно">
        </div>
        <div class="form-group">
            <label>Новый пароль</label>
            <input min="5" required value="{{$row->password_new}}" type="text" class="form-control" name="password_new" placeholder="Введите">
        </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>