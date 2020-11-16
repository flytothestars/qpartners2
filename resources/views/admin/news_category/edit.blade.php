<?php $title = 'Добавить категорию'; ?>
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
                            {{ Form::open(['action' => ['Admin\NewsCategoryController@update', 'id'=> $category->id], 'method' => 'PUT']) }}
                            {{ Form::token() }}
                            <div class="form-group">
                                {{ Form::label('Название категории', null, ['class' => 'control-label']) }}
                                {{ Form::text('name',$category->name, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Описание категории', null, ['class' => 'control-label']) }}
                                {{ Form::textarea('description',$category->description, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::checkbox('is_active',null,$category->is_active)}}
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