@extends('admin.layout.layout')

@section('content')

    <section class="content-header">
        <h1>
            {{--              {{ $title }}--}}
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8" style="padding-left: 0px">
                    <div class="box box-primary">
                        @if(!empty($errors->all()))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="box-body">
                            <div class="form-group">
                                {{Form::open(['url' => '/admin/about/'.(isset($row) ? $row->id : null), 'method' => 'POST' ])}}
                                <input type="hidden" name="_method" value="PUT">
                                {{Form::token()}}
                                {{Form::hidden('category_type', 'leader_persons')}}
                                {{Form::hidden('image',(isset($row) && $row->image ? $row->image : NULL), ['class' => 'image-name'])}}
                                <div class="form-group">
                                    {{Form::label('ФИО лидера', null,['class' => 'control-label'])}}
                                    {{Form::text('full_name',(isset($row) ? $row->full_name : null),['class' => 'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('Адрес лидера', null,['class' => 'control-label'])}}
                                    {{Form::text('address', (isset($row) ? $row->address : null),['class' => 'form-control', 'rows' => 20])}}
                                </div>


                                <div class="form-group">
                                    <input type="checkbox" name="has_instagram" class="checkbox"
                                           {{isset($instagramLink) ? 'checked' : ''}}
                                           style="padding: 0; margin: 0; display: inline-block;">
                                    &nbsp;
                                    <label for="has_instagram"><i class="fa fa-instagram"></i>
                                        instagram</label>
                                </div>
                                <div class="form-group  {{(isset($instagramLink) ? '' : 'hidden')}}"
                                     id="has_instagram">
                                    {{Form::label('Ссылка на instagram автора', null,['class' => 'control-label'])}}
                                    {{Form::text('person_instagram_link', (isset($instagramLink) ? $instagramLink->url : null),['class' => 'form-control'])}}
                                </div>


                                <div class="form-group">
                                    <input type="checkbox" name="has_facebook" class="checkbox"
                                           {{isset($facebookLink) ? 'checked' : ''}}
                                           style="padding: 0; margin: 0; display: inline-block;">
                                    &nbsp;
                                    <label for="has_facebook"><i class="fa fa-facebook"></i>
                                        facebook</label>
                                </div>
                                <div class="form-group  {{(isset($facebookLink) ? '' : 'hidden')}}"
                                     id="has_facebook">
                                    {{Form::label('Ссылка на facebook автора', null,['class' => 'control-label'])}}
                                    {{Form::text('person_facebook_link', (isset($facebookLink) ? $facebookLink->url : null),['class' => 'form-control'])}}
                                </div>


                                <div class="form-group">
                                    <input type="checkbox" name="has_twitter" class="checkbox"
                                           {{isset($twitterLink) ? 'checked' : ''}}
                                           style="padding: 0; margin: 0; display: inline-block;">
                                    &nbsp;
                                    <label for="has_twitter"><i class="fa fa-twitter"></i>
                                        twitter</label>
                                </div>
                                <div class="form-group  {{(isset($twitterLink) ? '' : 'hidden')}}"
                                     id="has_twitter">
                                    {{Form::label('Ссылка на twitter автора', null,['class' => 'control-label'])}}
                                    {{Form::text('person_twitter_link', (isset($twitterLink) ? $twitterLink->url : null),['class' => 'form-control'])}}
                                </div>





                                {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-primary" style="padding: 30px; text-align: center">
                        <div style="padding: 20px; border: 1px solid #c2e2f0">
                            <img class="image-src"
                                 src="{{isset($row) && $row->image ? $row->image:'/media/default.jpg'}}"
                                 style="width: 100%; "/>
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

@section('js')
    <script>
        $('.checkbox').change(function () {
            if (this.checked) {
                $('#' + this.name).removeClass('hidden');
            } else {
                $('#' + this.name).addClass('hidden');
            }
        });
    </script>
@endsection



