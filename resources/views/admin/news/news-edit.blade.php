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
                        @if($row->news_id > 0)
                            <form action="/admin/news/{{$row->news_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/news" method="POST">
                                        @endif
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="news_id" value="{{ $row->news_id }}">
                                        <input type="hidden"
                                               value="@if(isset($_GET['parent_id'])){{$_GET['parent_id']}}@endif"
                                               name="parent_id">
                                        <input type="hidden" value="{{ $row->news_image }}" name="news_image"
                                               class="image-name">
                                        <input type="hidden" value="{{ $row->news_images }}" name="news_images[]"
                                               id="images-name">

                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Название (Рус)</label>
                                                <input value="{{ $row->news_name_ru }}" type="text" class="form-control"
                                                       name="news_name_ru" placeholder="Введите">
                                            </div>
                                            <div class="form-group">
                                                <label>Краткий текст (Рус)</label>
                                                <textarea name="news_desc_ru" class="form-control">{!! $row->news_desc_ru  !!}
                                           </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Описание (Рус)</label>
                                                <textarea value="{{  $row->full_description_ru }}" type="text"
                                                          rows="15" class="form-control" name="full_description_ru"
                                                          placeholder="Введите">
                                                    {{$row->full_description_ru}}
                                           </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Название (Каз)</label>
                                                <input value="{{ $row->news_name_kz }}" type="text" class="form-control"
                                                       name="news_name_kz" placeholder="Введите">
                                            </div>
                                            <div class="form-group">
                                                <label>Краткий текст (Каз)</label>
                                                <textarea name="news_desc_kz"
                                                          class="form-control">{!! $row->news_desc_kz  !!}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Описание (Каз)</label>
                                                <textarea value="{!!  $row->full_description_kz !!}" type="text"
                                                          rows="15" class="form-control" name="full_description_kz"
                                                          placeholder="Введите">
                                                    {!!  $row->full_description_kz !!}
                                           </textarea>
                                            </div>
{{--                                            <div class="form-group">--}}
{{--                                                <label for="">Показывать на главной странице</label>--}}
{{--                                                <input type="checkbox" >--}}
{{--                                            </div>--}}
                                            <div class="form-group">
                                                <label>Дата</label>
                                                <input id="news_date" value="{{ $row->news_date }}" type="text"
                                                       class="form-control datetimepicker-input" name="news_date"
                                                       placeholder="Введите">
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
                            <img class="image-src" src="{{ $row->news_image }}" style="width: 100%; "/>
                        </div>
                        <div style="background-color: #c2e2f0;height: 40px;margin: 0 auto;width: 2px;"></div>
                        <form id="image_form" enctype="multipart/form-data" method="post" class="image-form">
                            <i class="fa fa-plus"></i>
                            <input id="avatar-file" type="file" onchange="uploadImage()" name="image"/>
                        </form>
                    </div>
                    <div class="box box-primary" style="padding: 30px; ">
                        <div class="multiple-images-list">

                        </div>
                        <div style="padding: 20px; border: 1px solid #c2e2f0">
                            <img class="images-src" src="{{ $row->images }}" style="width: 100%; "/>
                        </div>
                        <div style="background-color: #c2e2f0;height: 40px;margin: 0 auto;width: 2px;"></div>
                        <form id="images_form" enctype="multipart/form-data" method="post" class="image-form">

                            <i class="fa fa-plus"></i>
                            <input id="avatar-file" multiple type="file" onchange="uploadMultipleImages()"
                                   name="images[]"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

<style>
    .multiple-images-list {
        padding: 20px 5px 20px 5px;
        border: 1px solid #c2e2f0;
        height: auto;
        text-align: center;
    }

    .row-images-list {
        border-radius: 5px;
        border: 1px solid lightgrey;
        padding: 5px 5px 5px 5px;
        margin: 0 !important;

    }

    .image-box {
        border: 1px solid lightgrey;
        border-radius: 5px;
        height: 80px;
        width: 30%;
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
    }

    .image-trash {
        padding: 27px 0;
    }

    .image-trash i {
        cursor: pointer;
        font-size: 20px;
        color: red;
    }
</style>
