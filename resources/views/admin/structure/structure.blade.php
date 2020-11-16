@extends('admin.layout.layout')

@section('breadcrump')

    <section class="content-header">
        <h1>
            Структура
        </h1>
    </section>

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="structure-list">
                <div class="obsdiv" style="padding: 0 10px">
                    <div class="ulist">
                        <?php
                        use App\Models\Packet;use App\Models\UserPacket;use Illuminate\Support\Facades\Auth;$user_id = Auth::user()->user_id;
                        if (Auth::user()->role_id == 1) $user_id = 1;
                        $user_list = \App\Models\Users::where('recommend_user_id', $user_id)->take(20)->get();

                        $user = \App\Models\Users::leftJoin('user_status', 'user_status.user_status_id', '=', 'users.status_id')
                            ->where('user_id', $user_id)
                            ->first();
                        ?>

                        <ul class="level_1">
                            <li class="parent">

                                <?php
                                $LOProfitId = UserPacket::where('is_active', 1)
                                    ->where('user_id', Auth::user()->user_id)
                                    ->whereIn('packet_id', [23, 24, 25, 26, 27])
                                    ->max('packet_id');

                                $LOProfit = Packet::where('packet_id', $LOProfitId)->first();
                                $LOProfit = $LOProfit ? $LOProfit->packet_price : 0;

                                $gaps = 0;
                                ?>


                                @if(count($user_list) > 0)
                                    <span onclick="opUl(this)">+</span>
                                    <div class="dval act user-name">
                                        <div class="object-image client-image">
                                            <a @if(Auth::user()->role_id == 1) href="/admin/profile/{{$user->user_id}}"
                                               target="_blank" @endif>
                                                <img src="{{$user->avatar}}">
                                            </a>
                                        </div>
                                        <div class="left-float client-name">
                                            {{$user->login}}  @if(Auth::user()->user_id == 1)
                                                ({{$user->name}} {{$user->last_name}}
                                                ) @endif @include('admin.structure.user_packet_list_loop')
                                            <div style="padding-top: 5px; color: rgb(58, 58, 58);">
                                                <p style="color: #009551; margin: 0px">
                                                    Квалификация: {{$user->user_status_name}}</p>
                                                <div>
                                                    <p style="font-weight: 900; margin: 0px">
                                                        ЛО: {{ $LOProfit + $gaps }} $
                                                        ({{round(($LOProfit+$gaps) * \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}
                                                        тг)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clear-float"></div>
                                    </div>
                                    <ul class="level_2">
                                        {!! view('admin.structure.structure-list-loop-ajax',['user_id' => $user_id,'level' => '3']) !!}
                                    </ul>
                                @else
                                    <div class="dval act user-name">
                                        <div class="object-image client-image">
                                            <a @if(Auth::user()->role_id == 1) href="/admin/profile/{{$user->user_id}}"
                                               target="_blank" @endif>
                                                <img src="{{$user->avatar}}">
                                            </a>
                                        </div>
                                        <div class="left-float client-name">
                                            {{$user->login}}  @if(Auth::user()->user_id == 1) {{$user->name}} {{$user->last_name}} @endif @include('admin.structure.user_packet_list_loop')
                                            <div style="padding-top: 5px; color: rgb(58, 58, 58);">
                                                <p style="color: #009551; margin: 0px">
                                                    Квалификация: {{$user->user_status_name}}</p>
                                                <div>
                                                    <p style="font-weight: 900; margin: 0px">ЛО: {{ $LOProfit }} $
                                                        ({{round($LOProfit * \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}
                                                        тг)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clear-float"></div>
                                    </div>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

