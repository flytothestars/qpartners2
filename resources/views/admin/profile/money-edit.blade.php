<form action="/admin/profile/money/edit" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <input type="hidden" value="@if($row->user_id > 0){{$row->user_id}}@else{{Auth::user()->user_id}}@endif" name="user_id"/>
    <div class="form-group">
        <label>Текущий баланс</label>
        <input readonly value="{{$row->user_money}}" type="text" class="form-control" name="user_money" placeholder="Неизвестно">
    </div>
    <div class="form-group">
        <label>Снять баланс</label>
        <input min="0" max="{{$row->user_money}}" required value="{{$row->minus_money}}" type="text" class="form-control" name="minus_money" placeholder="Введите">
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>