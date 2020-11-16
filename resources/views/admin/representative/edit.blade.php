<?php

use Illuminate\Support\Arr;

$title = 'Редактировать представителя';
$cities = \App\Models\City::all();
$cities = collect($cities);
$cities = $cities->all();
$cities = Arr::pluck($cities, 'city_name_ru', 'city_id');
?>
@extends('admin.layout.layout')

@section('content')

    <section class="content-header">
        <h1>
            {{ $title }}
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12" style="padding-left: 0px">
                    <div class="box box-primary">
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        <div class="box-body">
                            {{ Form::open(['action' => ['Admin\RepresentativeController@update', 'id'=> $representative->id], 'method' => 'PUT']) }}
                            {{ Form::token() }}
                            <div class="form-group">
                                {{ Form::label('Выберите город', null, ['class' => 'control-label']) }}
                                {{Form::select("city_id",$cities,  $representative->city_id,
                                     [
                                        "class" => "form-group form-control",
                                        "placeholder" => "Выберите город"
                                     ])
                                 }}
                            </div>
                            <div class="form-group">
                                {{Form::label('Укажите адрес', null, ['class' => 'control-label'])}}
                                {{Form::text('address', $representative->address, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('ФИО',null, ['class' => 'control-label']) }}
                                {{ Form::text('full_name', $representative->full_name, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Номер телефона', null, ['class' => 'control-label']) }}
                                {{ Form::text('phone_number',$representative->phone_number, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Whatsapp номер', null, ['class' => 'control-label']) }}
                                {{ Form::text('whatsapp',$representative->whatsapp, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Instagram', null, ['class' => 'control-label']) }}
                                {{ Form::text('instagram',$representative->instagram, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::checkbox('is_active',NULL,$representative->is_active)}}
                                {{ Form::label('Активный (показывать на странице FAQ)', null, ['class' => 'control-label']) }}
                            </div>
                            {{ Form::submit('Создать', ['class'=> 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection