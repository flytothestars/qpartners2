@extends('admin.layout.layout')

@section('breadcrump')


@endsection

@section('content')

    @include('admin.index.profit')

    @include('admin.index.home-profit')

    {{--@include('admin.index.auto-profit')--}}

    {{--@include('admin.index.passive-profit')--}}

    @include('admin.index.money')

    @if(Auth::user()->role_id == 1)
        @include('admin.index.statistics')
    @endif

    @if(\App\Models\UserPacket::where('packet_id','>',2)
                                  ->where('is_active','1')
                                  ->where('user_id',Auth::user()->user_id)
                                  ->count() > 0 || Auth::user()->role_id == 1)



    @endif

    @include('admin.index.packet')

@endsection


