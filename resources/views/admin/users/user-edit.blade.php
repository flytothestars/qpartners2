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
                               @if($row->user_id > 0)
                                   <form action="/admin/user/{{$row->user_id}}" method="POST">
                                   <input type="hidden" name="_method" value="PUT">
                               @else
                                   <form action="/admin/user" method="POST">
                               @endif

                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   <input id="user_id" type="hidden" name="user_id" value="{{ $row->user_id }}">
                                   <input type="hidden" class="image-name" id="avatar" name="avatar" value="{{ $row->avatar }}"/>

                                   <div class="box-body">
                                       <div class="form-group">
                                           <label>ФИО</label>
                                           <input value="{{ $row->name }}" type="text" class="form-control" name="name" placeholder="Введите">
                                       </div>
                                       <div class="form-group">
                                          <label>Email</label>
                                          <input value="{{ $row->email }}" type="text" class="form-control" name="email" placeholder="Введите">
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

