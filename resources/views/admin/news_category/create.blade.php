<?php $title = 'Добавить категорию новостей'; ?>
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
                            {{ Form::open(['action' => ['Admin\NewsCategoryController@store'], 'method' => 'POST']) }}
                            {{ Form::token() }}
                            <div class="form-group">
                                {{ Form::label('Название категории', null, ['class' => 'control-label']) }}
                                {{ Form::text('name',null, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Описание категории', null, ['class' => 'control-label']) }}
                                {{ Form::textarea('description',null, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::checkbox('is_active')}}
                                {{ Form::label('Активный', null, ['class' => 'control-label']) }}
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