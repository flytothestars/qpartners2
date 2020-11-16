<tr @if(Auth::user()->user_id == $val->user_id) style="background-color: rgb(231, 231, 231);" @endif>
    <td> {{ $val->queue_now_position }}</td>
    <td>
        <div class="object-image client-image">
            <a @if(Auth::user()->role_id == 1) href="/admin/profile/{{$val->user_id}}" target="_blank" @endif>
                <img src="{{$val->avatar}}">
            </a>
        </div>
        <div class="clear-float"></div>
    </td>
    <td class="arial-font">
        <a class="main-label" @if(Auth::user()->role_id == 1) href="/admin/profile/{{$val->user_id}}" target="_blank" @endif><p class="login">{{$val->login}}</p>@if(Auth::user()->user_id == 1)<p class="client-name">{{ $val->name }} {{ $val->last_name }} {{ $val->middle_name }}</p>@endif</a>
    </td>
    <td class="arial-font">
        <a class="main-label" @if(Auth::user()->role_id == 1) href="/admin/profile/{{$val->recommend_id}}" target="_blank" @endif><p class="login">{{$val->recommend_login}}</p>@if(Auth::user()->user_id == 1)<p class="client-name">{{ $val->recommend_name }} {{ $val->recommend_last_name }} {{ $val->recommend_middle_name }}</p>@endif</a>
    </td>
    <td class="arial-font">
        <div>
            {{ $val->queue_now_position }}
        </div>
    </td>
    <td class="arial-font">
        <div>
            {{ $val->country_name_ru }}
        </div>
        <div>
            {{ $val->city_name_ru }}
        </div>
    </td>
</tr>
