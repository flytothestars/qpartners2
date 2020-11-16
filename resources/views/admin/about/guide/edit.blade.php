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
                                {{Form::open(['url' => '/admin/about/'  .(isset($row) ? $row->id : null)  , 'method' => 'POST' ])}}
                                <input type="hidden" name="_method" value="PUT">
                                {{Form::token()}}
                                {{Form::hidden('category_type', 'guide')}}
                                <div class="form-group">
                                    {{Form::label('Название (Загаловок)', null,['class' => 'control-label'])}}
                                    {{Form::text('title',(isset($row) ? $row->title : null),['class' => 'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('Текст (Слова руководителя)', null,['class' => 'control-label'])}}
                                    {{Form::textarea('text_body', (isset($row) ? strip_tags($row->text_body) : null),['class' => 'form-control', 'rows' => 20])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('Фамилия Имя Отчество автора', null,['class' => 'control-label'])}}
                                    {{Form::text('author_full_name', (isset($row) ? $row->author_full_name : null),['class' => 'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('Должность автора', null,['class' => 'control-label'])}}
                                    {{Form::text('author_responsibility', (isset($row) ? $row->author_responsibility : null),['class' => 'form-control'])}}
                                </div>

                                <div class="form-group">
                                    <input type="checkbox"
                                           {{!empty($row->author_instagram_link) ? 'checked' : ''}} name="has_instagram"
                                           class="checkbox"
                                           style="padding: 0; margin: 0; display: inline-block;">
                                    &nbsp;
                                    <label for="has_instagram"><i class="fa fa-instagram"></i>
                                        instagram</label>
                                </div>
                                <div class="form-group {{empty($row->author_instagram_link) ? 'hidden' : ''}}"
                                     id="has_instagram">
                                    {{Form::label('Ссылка на instagram автора', null,['class' => 'control-label'])}}
                                    {{Form::text('author_instagram_link', (isset($row) ? $row->author_instagram_link : null),['class' => 'form-control'])}}
                                </div>

                                <div class="form-group">
                                    <input type="checkbox"
                                           {{!empty($row->author_facebook_link) ? 'checked' : ''}} name="has_facebook"
                                           class="checkbox"
                                           style="padding: 0; margin: 0; display: inline-block;">
                                    &nbsp;
                                    <label for="has_facebook"><i class="fa fa-facebook"></i>
                                        facebook</label>
                                </div>
                                <div class="form-group  {{empty($row->author_facebook_link) ? 'hidden' : ''}}"
                                     id="has_facebook">
                                    {{Form::label('Ссылка на facebook автора', null,['class' => 'control-label'])}}
                                    {{Form::text('author_facebook_link', (isset($row) ? $row->author_facebook_link : null),['class' => 'form-control'])}}
                                </div>

                                <div class="form-group">
                                    <input type="checkbox"
                                           {{!empty($row->author_whatsapp_link) ? 'checked' : ''}} name="has_whatsapp"
                                           class="checkbox"
                                           style="padding: 0; margin: 0; display: inline-block;">
                                    &nbsp;
                                    <label for="has_whatsapp"><i class="fa fa-whatsapp"></i>
                                        whatsapp</label>
                                </div>
                                <div class="form-group  {{empty($row->author_whatsapp_link) ? 'hidden' : ''}}"
                                     id="has_whatsapp">
                                    {{Form::label('Ссылка на whatsapp автора', null,['class' => 'control-label'])}}
                                    {{Form::text('author_whatsapp_link', (isset($row) ? $row->author_whatsapp_link : null),['class' => 'form-control'])}}
                                </div>

                                <div class="form-group">
                                    <input type="checkbox"
                                           {{!empty($row->author_twitter_link) ? 'checked' : ''}} name="has_twitter"
                                           class="checkbox"
                                           style="padding: 0; margin: 0; display: inline-block;">
                                    &nbsp;
                                    <label for="has_twitter"><i class="fa fa-twitter"></i>
                                        twitter</label>
                                </div>
                                <div class="form-group  {{empty($row->author_twitter_link) ? 'hidden' : ''}}"
                                     id="has_twitter">
                                    {{Form::label('Ссылка на twitter автора', null,['class' => 'control-label'])}}
                                    {{Form::text('author_twitter_link', (isset($row) ? $row->author_twitter_link : null),['class' => 'form-control'])}}
                                </div>
                                {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
                                {{Form::close()}}
                            </div>
                        </div>
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



