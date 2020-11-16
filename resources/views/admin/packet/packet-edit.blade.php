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
                               <form action="/admin/packet-item/{{$row->packet_id}}" method="POST">
                                   <input type="hidden" name="_method" value="PUT">
                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   <input type="hidden" name="packet_id" value="{{ $row->packet_id }}">
                                   <input type="hidden" value="{{ $row->packet_image }}" name="packet_image" class="image-name">

                                   <div class="box-body">
                                       <div class="form-group">
                                           <label>Название (Рус)</label>
                                           <input value="{{ $row->packet_name_ru }}" type="text" class="form-control" name="packet_name_ru" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Доля</label>
                                           <input value="{{ $row->packet_share }}" type="text" class="form-control" name="packet_share" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Услуга</label>
                                           <input value="{{ $row->packet_lection }}" type="text" class="form-control" name="packet_lection" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Товар</label>
                                           <input value="{{ $row->packet_thing }}" type="text" class="form-control" name="packet_thing" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Порядковый номер сортировки</label>
                                           <input value="{{ $row->sort_num }}" type="text" class="form-control" name="sort_num" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Сумма (PV)</label>
                                           <input value="{{ $row->packet_price }}" type="number" class="form-control" name="packet_price" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                            <label>
                                                Показать
                                            </label>
                                       </div>
                                       <div class="form-group">                                            
                                            <label>
                                                <input value="1" type="radio" class="form-check-input" name="is_show" {{ $row->is_show == 1 ? 'checked' : ''}}>
                                                Да 
                                            </label>
                                            <label>
                                                <input value="0" type="radio" class="form-check-input" name="is_show" {{ $row->is_show == 0 ? 'checked' : ''}}>
                                                Нет
                                            </label>
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
                                <img class="image-src" src="{{ $row->packet_image }}" style="width: 100%; "/>
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

