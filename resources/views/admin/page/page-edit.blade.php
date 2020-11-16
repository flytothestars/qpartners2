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
                           @if($row->page_id > 0)
                               <form action="/admin/page/{{$row->page_id}}" method="POST">
                                   <input type="hidden" name="_method" value="PUT">
                           @else
                               <form action="/admin/page" method="POST">
                           @endif
                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   <input type="hidden" name="page_id" value="{{ $row->page_id }}">
                                   <input type="hidden" value="@if(isset($_GET['parent_id'])){{$_GET['parent_id']}}@endif" name="parent_id">

                                   <div class="box-body">
                                       <div class="form-group">
                                           <label>Название</label>
                                           <input value="{{ $row->page_name_ru }}" type="text" class="form-control" name="page_name_ru" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Текст (Рус) </label>
                                           <textarea name="page_text_ru" class="form-control text_editor"><?=$row->page_text_ru?></textarea>
                                       </div>
                                       <div class="form-group">
                                           <label>Текст (Каз) </label>
                                           <textarea name="page_text_kz" class="form-control text_editor"><?=$row->page_text_kz?></textarea>
                                       </div>
                                       <div class="form-group">
                                           <label>Текст (Анг) </label>
                                           <textarea name="page_text_en" class="form-control text_editor"><?=$row->page_text_en?></textarea>
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

