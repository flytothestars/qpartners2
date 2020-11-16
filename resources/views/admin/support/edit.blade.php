@extends('admin.layout.layout')

@section('breadcrump')

    <section class="content-header">
        <h1>
            Служба поддержки
        </h1>
    </section>

@endsection

@section('content')

    <div class="row">
        <div class="col-sm-8">
            <label for="question">Вопрос</label>
            <span style="float: right;"> <strong>Дата отправки:</strong> &nbsp;
                <time
                        datetime="2016-02-03 20:00">{{date('d.m.y H:m:i',strtotime($opportunityFaq->created_at))}}</time>
            </span>
            <textarea style="width: 100%;" name="question" id="" cols="30" rows="12" readonly>
            </textarea>
            <label for="question">Ответ</label>
            <textarea style="width: 100%;" name="question" id="" cols="30" rows="12">
            </textarea>
        </div>
        <div class="col-sm-4">
            <div style="width: 100%; height: 500px;background-color: white;">
            </div>
        </div>
    </div>
@endsection

