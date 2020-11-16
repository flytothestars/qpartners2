<form action="/admin/profile/profit/edit" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <input type="hidden" value="@if($row->user_id > 0){{$row->user_id}}@else{{Auth::user()->user_id}}@endif" name="user_id"/>
    <div class="form-group">
        <label>Левый командный объем</label>
        <input required value="{{$row->left_child_profit}}" type="text" class="form-control" name="left_child_profit" placeholder="Введите">
    </div>
    <div class="form-group">
        <label>Правый командный объем</label>
        <input required value="{{$row->right_child_profit}}" type="text" class="form-control" name="right_child_profit" placeholder="Введите">
    </div>
    <div class="form-group">
        <label>Квалификационный объем</label>
        <input required value="{{$row->qualification_profit}}" type="text" class="form-control" name="qualification_profit" placeholder="Введите">
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>