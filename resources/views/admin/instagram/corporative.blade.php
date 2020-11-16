@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a href="/admin/instagram/partners" class="menu-tab">Партнерские аккаунты</a>
                    </h3>
                    <h3 class="box-title box-title-second" style="margin-right: 15px" >
                        <a href="/admin/instagram/corporative" class="menu-tab active-page">Корпоративные аккаунты</a>
                    </h3>
                    <h3 class="box-title box-title-second" >
                        <a href="/admin/instagram/recommend" class="menu-tab">Рекомендуемые аккаунты</a>
                    </h3>
                    @if(Auth::user()->role_id == 1)
                        <a href="/admin/instagram/create" style="float: right">
                            <button class="btn btn-primary box-add-btn">Добавить аккаунт</button>
                        </a>
                    @endif

                    <div class="clear-float"></div>
                </div>
                <div class="box-body">

                    <div class="nav-tabs-custom">

                        <div class="tab-content" >
                            <div>

                                <table id="news_datatable" class="table table-bordered table-striped table-css">
                                    <thead>
                                    <tr>
                                        <th style="width: 30px">№</th>
                                        <th style="width: 20px">Аватар</th>
                                        <th>Аккаунт</th>
                                        <th>Аккаунт инстаграм</th>
                                        <th>Действие</th>
                                        @if(Auth::user()->role_id == 1)
                                            <th style="width: 20px"></th>
                                            <th style="width: 20px"></th>
                                        @endif
                                    </tr>
                                    </thead>

                                    <tbody>

                                    {{--<tr>
                                        <td></td>
                                        <td><input type="hidden" value="1" name="level"></td>
                                        <td><input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск"></td>
                                        <td><input value="{{$request->sponsor_name}}" type="text" class="form-control" name="sponsor_name" placeholder="Поиск"></td>
                                        <td></td>
                                        <td></td>
                                        <td><input value="{{$request->city_name}}" type="text" class="form-control" name="city_name" placeholder="Поиск"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>--}}

                                    @foreach($partners as $key => $val)

                                        <tr>
                                            <td> {{ $key + 1 }}</td>
                                            <td>
                                                <div class="object-image client-image">
                                                    <a href="https://www.instagram.com/{{ $val->instagram }}" target="_blank">
                                                        <img src="{{$val->avatar}}">
                                                    </a>
                                                </div>
                                                <div class="clear-float"></div>
                                            </td>
                                            <td class="arial-font">
                                                {{ $val->name }}
                                            </td>
                                            <td class="arial-font">
                                                <?php $val->instagram = str_replace(['https://instagram.com/','https://instagram.com','instagram.com/','instagram.com'],'',$val->instagram); ?>

                                                <div>
                                                    <a style="text-decoration: underline" href="https://www.instagram.com/{{ $val->instagram }}" target="_blank">
                                                        {{ $val->instagram }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="arial-font">
                                                <div>


                                                    <?php $user_subscribe = \App\Models\UserSubscribe::where('sender_id',Auth::user()->user_id)->where('instagram_id',$val->instagram_id)->first(); ?>

                                                    @if($user_subscribe == null)

                                                        <button onclick="subscribeInstagramPartner(this,'{{$val->instagram_id}}','https://instagram.com/{{ $val->instagram }}')" class="btn btn-block btn-success btn-sm" style="background-color: #3C8DBC !important;">Подписаться</button>

                                                    @elseif($user_subscribe->is_success == 0)
                                                        <a href="https://www.instagram.com/{{ $val->instagram }}" target="_blank">
                                                            <button class="btn btn-block btn-success btn-sm" style="background-color: #F9BF3B !important;">Отправлено</button>
                                                        </a>
                                                    @else
                                                        <a href="https://www.instagram.com/{{ $val->instagram }}" target="_blank">
                                                            <button class="btn btn-block btn-success btn-sm">Подписаны</button>
                                                        </a>

                                                    @endif

                                                </div>
                                            </td>

                                            @if(Auth::user()->role_id == 1)

                                                <td style="text-align: center">
                                                     <a href="/admin/instagram/{{ $val->instagram_id }}/edit">
                                                         <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                                     </a>
                                                 </td>
                                                 <td style="text-align: center">
                                                     <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->instagram_id }}','instagram')">
                                                         <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                                     </a>
                                                 </td>

                                            @endif

                                        </tr>

                                    @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection