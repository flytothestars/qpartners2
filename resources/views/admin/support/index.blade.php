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
        <div class="col-xs-12">
            <div class="box-body">
                <table id="packet_datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr style="border: 1px">
                        <td>#</td>
                        <td>Имя пользователя</td>
                        <td>Почта пользователя</td>
                        <td>Номер телефона пользователя</td>
                        <td>Вопрос</td>
                        <td>Статус</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($opportunityFaqs as $faq)
                        <tr>
                            <td>{{$faq->id}}</td>
                            <td>{{$faq->user_name}}</td>
                            <td>{{$faq->user_email}}</td>
                            <td>{{$faq->user_phone}}</td>
                            <td>{{$faq->question}}</td>
                            <td>{{$faq->status_id}}</td>
                            <td><a href="{{route('support.edit', ['id ' => $faq->id ])}}"><i style="color: blue;" class="fa fa-eye"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection

