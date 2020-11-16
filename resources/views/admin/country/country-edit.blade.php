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
                           @if($row->country_id > 0)
                               <form action="/admin/country/{{$row->country_id}}" method="POST">
                                   <input type="hidden" name="_method" value="PUT">
                           @else
                               <form action="/admin/country" method="POST">
                           @endif
                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   <input type="hidden" name="country_id" value="{{ $row->country_id }}">
                                   <input type="hidden" value="@if(isset($_GET['parent_id'])){{$_GET['parent_id']}}@endif" name="parent_id">
                                   <input type="hidden" value="{{ $row->country_image }}" name="country_image" class="image-name">

                                   <div class="box-body">
                                       <div class="form-group">
                                           <label>Название (Рус)</label>
                                           <input value="{{ $row->country_name_ru }}" type="text" class="form-control" name="country_name_ru" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Название (Каз)</label>
                                           <input value="{{ $row->country_name_kz }}" type="text" class="form-control" name="country_name_kz" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Название (Анг)</label>
                                           <input value="{{ $row->country_name_en }}" type="text" class="form-control" name="country_name_en" placeholder="Введите">
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

                </div>

            </div>
        </section>

@endsection

