@if(isset($first_item))
    <ul class="level_1">
@endif

    <?php
    $user_list = \App\Models\Users::where('recommend_user_id',$user_id)->take(20)->get();
    $user = \App\Models\Users::find($user_id);
    ?>

    <li class="parent">
        @if(count($user_list) > 0)
            <span onclick="opUl(this)">+</span>
            <div class="dval act user-name">
                <div class="object-image client-image">
                    <a @if(Auth::user()->role_id == 1) href="/admin/profile/{{$user->user_id}}" target="_blank" @endif>
                        <img src="{{$user->avatar}}">
                    </a>
                </div>
                <div class="left-float client-name">
                    {{$user->login}}
                </div>
                <div class="clear-float"></div>
            </div>
            <ul class="level_2">
                @foreach($user_list as $key => $item)
                    {!! view('admin.structure.structure-list-loop',['user_id' => $item->user_id,'key' => $key]) !!}
                @endforeach
            </ul>
        @else
            <div class="dval act user-name">
                <div class="object-image client-image">
                    <a @if(Auth::user()->role_id == 1) href="/admin/profile/{{$user->user_id}}" target="_blank" @endif>
                        <img src="{{$user->avatar}}">
                    </a>
                </div>
                <div class="left-float client-name">
                    {{$user->name}} @include('admin.structure.user_packet_list_loop')
                </div>
                <div class="clear-float"></div>
            </div>
        @endif
    </li>

@if(isset($first_item))
    </ul>
@endif
