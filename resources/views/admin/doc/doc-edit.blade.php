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
                        @if($row->doc_id > 0)
                            <form action="/admin/doc/{{$row->doc_id}}" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/doc" enctype="multipart/form-data" method="POST">
                                        @endif
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="doc_id" value="{{ $row->doc_id }}">
                                        <input type="hidden" value="@if(isset($_GET['specialization_id'])){{$_GET['specialization_id']}}@else{{$row->specialization_id}}@endif" name="specialization_id">
                                        <input type="hidden" class="image-name" id="doc_image" name="doc_image" value="{{ $row->doc_image }}"/>

                                        <div class="box-body">

                                            <div class="nav-tabs-custom">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#rus" data-toggle="tab">Русский</a>
                                                    </li>
                                                    <li>
                                                        <a href="#kaz" data-toggle="tab">Казахский</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="active tab-pane" id="rus">
                                                        <div class="form-group">
                                                            <label>Название (ru)</label>
                                                            <textarea name="doc_name_ru" class="form-control"><?=$row->doc_name_ru?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>файл</label>
                                                            <input type="file" value="@if(isset($row->doc_pdf_ru)){{$row->doc_pdf_ru}}@endif" name="doc_pdf_ru" />
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="kaz">
                                                        <div class="form-group">
                                                            <label>Название (kz)</label>
                                                            <textarea name="doc_name_kz" class="form-control"><?=$row->doc_name_kz?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>файл</label>
                                                            <input type="file" value="@if(isset($row->doc_pdf_kz)){{$row->doc_pdf_kz}}@endif" name="doc_pdf_kz" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Порядковый номер сортировки</label>
                                                        <input value="{{ $row->sort_num }}" type="text" class="form-control" name="sort_num" placeholder="Введите">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                        </div>
                                    </form>

                    </div>
                </div>
                {{-- <div class="col-md-4">
                     <div class="box box-primary" style="padding: 30px; text-align: center">
                         <div style="padding: 20px; border: 1px solid #c2e2f0">
                             <img class="image-src" src="{{ $row->doc_image }}" style="width: 100%; "/>
                         </div>
                         <div style="background-color: #c2e2f0;height: 40px;margin: 0 auto;width: 2px;"></div>
                         <form id="image_form" enctype="multipart/form-data" method="post" class="image-form">
                             <i class="fa fa-plus"></i>
                             <input id="avatar-file" type="file" onchange="uploadImage()" name="image"/>
                         </form>
                     </div>
                 </div>--}}
            </div>
        </div>
    </section>


@endsection

