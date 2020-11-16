<div title="{{$user->last_name}} {{$user->name}}" class="quadrate @if($user->status_id == null) yellow-square @elseif($user->is_activated == 0) red-square @elseif($user->status_id == 1) violet-square @elseif($user->status_id == 2) orange-square @elseif($user->status_id == 3) blue-square @elseif($user->status_id == 12) start-square @elseif($user->status_id > 3) pink-square @else green-square @endif  @if($user->recommend_user_id == $main_user_id) binary-circle @endif">
    <div class="left_volume">{{$user->left_child_profit}}</div>
    <div class="user_id">{{$user->user_id}}</div>
    <div class="right_volume">{{$user->right_child_profit}}</div>
</div>

@if(isset($first_user))
    <div class="top-line">л|п</div>
@endif