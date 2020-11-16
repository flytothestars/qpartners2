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
                           @if($row->slider_id > 0)
                               <form action="/admin/slider/{{$row->slider_id}}" method="POST">
                                   <input type="hidden" name="_method" value="PUT">
                           @else
                               <form action="/admin/slider" method="POST">
                           @endif
                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   <input type="hidden" name="slider_id" value="{{ $row->slider_id }}">
                                   <input type="hidden" value="@if(isset($_GET['parent_id'])){{$_GET['parent_id']}}@endif" name="parent_id">
                                   <input type="hidden" value="{{ $row->slider_image }}" name="slider_image" class="image-name">

                                   <div class="box-body">
                                       <div class="form-group">
                                           <label>Название (Рус)</label>
                                           <input value="{{ $row->slider_name_ru }}" type="text" class="form-control" name="slider_name_ru" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Порядковый номер сортировки</label>
                                           <input value="{{ $row->sort_num }}" type="text" class="form-control" name="sort_num" placeholder="Введите">
                                       </div>
                                   </div>
                                   <div class="box-footer">
                                       <button type="submit" class="btn btn-primary">Сохранить</button>
                                   </div>
                                </form>
                       </div>
                   </div>
                    <div class="col-md-4">
                        <div class="box box-primary" style="padding: 30px; text-align: center">
                            <div style="padding: 20px; border: 1px solid #c2e2f0">
                                <img class="image-src" src="{{ $row->slider_image }}" style="width: 100%; "/>
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

