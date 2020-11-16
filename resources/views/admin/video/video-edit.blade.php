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
                           @if($row->video_id > 0)
                               <form action="/admin/video/{{$row->video_id}}" method="POST">
                                   <input type="hidden" name="_method" value="PUT">
                           @else
                               <form action="/admin/video" method="POST">
                           @endif
                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   <input type="hidden" name="video_id" value="{{ $row->video_id }}">
                                   <input type="hidden" value="@if(isset($_GET['parent_id'])){{$_GET['parent_id']}}@endif" name="parent_id">
                                   <input type="hidden" value="{{ $row->video_image }}" name="video_image" class="image-name">

                                   <div class="box-body">
                                       <div class="form-group">
                                           <label>Название (Рус)</label>
                                           <input value="{{ $row->video_name_ru }}" type="text" class="form-control" name="video_name_ru" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Название (Каз)</label>
                                           <input value="{{ $row->video_name_kz }}" type="text" class="form-control" name="video_name_kz" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Название (Анг)</label>
                                           <input value="{{ $row->video_name_en }}" type="text" class="form-control" name="video_name_en" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Cсылка на видео (Рус)</label>
                                           <input value="{{ $row->video_text_ru }}" type="text" class="form-control" name="video_text_ru" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Cсылка на видео (Каз)</label>
                                           <input value="{{ $row->video_text_kz }}" type="text" class="form-control" name="video_text_kz" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Cсылка на видео (Анг)</label>
                                           <input value="{{ $row->video_text_en }}" type="text" class="form-control" name="video_text_en" placeholder="Введите">
                                       </div>
                                   </div>
                                   <div class="box-footer">
                                       <button type="submit" class="btn btn-primary">Сохранить</button>
                                   </div>
                                </form>
                       </div>
                   </div>

                </div>

            </div>
        </section>

@endsection

