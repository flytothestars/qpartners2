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
                <div class="col-md-8" style="padding-left: 0px">
                    <div class="box box-primary">
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        <div class="box-body">
                            {{ Form::open(['action' => ['Admin\CategoryController@store'], 'method' => 'POST']) }}
                            {{ Form::token() }}
                            <input type="hidden" name="image"
                                   class="image-name">
                            <div class="form-group">
                                {{ Form::label('Название категорий', null, ['class' => 'control-label']) }}
                                {{ Form::text('name',null, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Описание категорий', null, ['class' => 'control-label']) }}
                                {{ Form::textarea('description',null, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::checkbox('is_show')}}
                                {{ Form::label('Показывать на главной странице', null, ['class' => 'control-label']) }}
                            </div>
                            {{ Form::submit('Создать', ['class'=> 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-primary" style="padding: 30px; text-align: center">
                        <div style="padding: 20px; border: 1px solid #c2e2f0">
                            <img class="image-src" src="/media/default.jpg" style="width: 100%; "/>
                        </div>
                        <div style="background-color: #c2e2f0;height: 40px;margin: 0 auto;width: 2px;"></div>
                        <form id="image_form" enctype="multipart/form-data" method="post" class="image-form">
                            <i class="fa fa-plus"></i>
                            <input id="avatar-file" type="file" onchange="uploadImage()" name="image"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection