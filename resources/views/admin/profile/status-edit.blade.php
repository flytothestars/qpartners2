<form action="/admin/profile/status/edit" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <input type="hidden" value="@if($row->user_id > 0){{$row->user_id}}@else{{Auth::user()->user_id}}@endif" name="user_id"/>

    <div class="form-group">
        <label>Статус</label>
        <select name="status_id" class="form-control" data-live-search="true">
            <option value="0" selected="selected"></option>
            @foreach($row->statuses as $item)
                <option @if($row->status_id == $item->user_status_id) {{'selected'}} @endif value="{{$item->user_status_id}}">{{$item['user_status_name']}}</option>
            @endforeach

        </select>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>