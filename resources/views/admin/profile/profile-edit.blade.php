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

                               <form action="/admin/profile/edit" method="POST">
                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   <input id="user_id" type="hidden" name="user_id" value="{{ $row->user_id }}">
                                   <input type="hidden" class="image-name" id="avatar" name="avatar" value="{{ $row->avatar }}"/>

                                   <div class="box-body">

                                       @if(Auth::user()->role_id == 1)
                                           <div class="form-group">
                                               <label>Статус</label>
                                               <select name="status_id" class="form-control" data-live-search="true">
                                                   <option value="0" selected="selected"></option>
                                                   @foreach($statuses as $item)
                                                       <option @if($row->status_id == $item->user_status_id) {{'selected'}} @endif value="{{$item->user_status_id}}">{{$item['user_status_name']}}</option>
                                                   @endforeach

                                               </select>
                                           </div>
                                        @endif


                                       <div class="form-group">
                                           <label>Имя</label>
                                           <input value="{{ $row->name }}" type="text" class="form-control" name="name" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Фамилия</label>
                                           <input value="{{ $row->last_name }}" type="text" class="form-control" name="last_name" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Отчество</label>
                                           <input value="{{ $row->middle_name }}" type="text" class="form-control" name="middle_name" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                          <label>Email</label>
                                          <input value="{{ $row->email }}" type="text" class="form-control" name="email" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Логин</label>
                                           <input value="{{ $row->login }}" type="text" class="form-control" name="login" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Инстаграм</label>
                                           <input  type="text" name="instagram" value="{{$row->instagram}}" class="form-control" placeholder="Инстаграм аккаунт"/>
                                       </div>
                                       <div class="form-group">
                                           <label>Телефон</label>
                                           <input value="{{ $row->phone }}" type="text" class="form-control" name="phone" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Удостоверение личности</label>
                                           <input value="{{ $row->document_number }}" type="text" class="form-control" name="document_number" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>ИИН</label>
                                           <input value="{{ $row->iin }}" type="text" class="form-control" name="iin" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>IBAN</label>
                                           <input value="{{ $row->iban }}" type="text" class="form-control iban-mask" name="iban" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Номер карточки</label>
                                           <input value="{{ $row->card_number }}" type="text" class="form-control card-mask" name="card_number" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Название банка</label>
                                           <input value="{{ $row->bank_name }}" type="text" class="form-control" name="bank_name" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                           <label>Страна</label>
                                           <select onchange="getCityListByCountry(this)"  name="country_id" data-placeholder="Выберите страну" class="form-control" data-live-search="true">
                                               @foreach($country_row as $item)
                                                   <option @if($row->country_id == $item->country_id) {{'selected'}} @endif value="{{$item->country_id}}">{{$item['country_name_ru']}}</option>
                                               @endforeach

                                           </select>
                                       </div>
                                       <div class="form-group">
                                           <select id="city_id" required name="city_id" data-placeholder="Выберите город" class="form-control" data-live-search="true">
                                               <option value="">Выберите город</option>
                                               @foreach($city_row as $item)
                                                   <option @if($row->city_id == $item->city_id) {{'selected'}} @endif value="{{$item->city_id}}">{{$item['city_name_ru']}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                       <div class="form-group">
                                           <input required type="text" name="address" value="{{$row->address}}" class="form-control" placeholder="Район"/>
                                       </div>
                                       {{--<div class="form-group">
                                           <label>Размер кольца</label>
                                           <input value="{{ $row->size_ring }}" type="text" class="form-control" name="size_ring" placeholder="Введите">
                                       </div>--}}
                                       <div class="form-group">
                                           <label>Пол</label>
                                           <select required name="is_male" data-placeholder="Выберите пол" class="form-control" data-live-search="true">
                                               <option @if($row->is_male == 0) {{'selected'}} @endif value="0">Женский</option>
                                               <option @if($row->is_male == 1) {{'selected'}} @endif value="1">Мужской</option>
                                           </select>
                                       </div>
                                      {{-- <div class="form-group">
                                           <label>Страховка </label>
                                           <select required name="is_insurance" data-placeholder="Выберите пол" class="form-control" data-live-search="true">
                                               <option @if($row->is_insurance == 0) {{'selected'}} @endif value="0">Нет</option>
                                               <option @if($row->is_insurance == 1) {{'selected'}} @endif value="1">Да</option>
                                           </select>
                                       </div>
                                       <div class="form-group">
                                           <label>Юридическая карта </label>
                                           <select required name="is_legal_map" data-placeholder="Выберите пол" class="form-control" data-live-search="true">
                                               <option @if($row->is_legal_map == 0) {{'selected'}} @endif value="0">Нет</option>
                                               <option @if($row->is_legal_map == 1) {{'selected'}} @endif value="1">Да</option>
                                           </select>
                                       </div>--}}
                                       <div class="form-group">
                                           <label>Обучение </label>
                                           <select required name="is_education" data-placeholder="Выберите пол" class="form-control" data-live-search="true">
                                               <option @if($row->is_education == 0) {{'selected'}} @endif value="0">Нет</option>
                                               <option @if($row->is_education == 1) {{'selected'}} @endif value="1">Да</option>
                                           </select>
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
                               <img class="image-src" src="{{ $row->avatar }}" style="width: 100%; "/>
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

