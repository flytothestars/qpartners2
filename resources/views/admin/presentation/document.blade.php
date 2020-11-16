@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="box-header">
                        <h1 class="box-title main-title">
                            Документы
                        </h1>
                        <div class="clear-float"></div>
                    </div>
                    <div class="nav-tabs-custom">
                        <div class="tab-content" >
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#qaz" data-toggle="tab">Қазақша</a>
                                    </li>
                                    <li>
                                        <a href="#rus" data-toggle="tab">Русский</a>
                                    </li>
                                </ul>
                                <div class="tab-content" style="min-height: 400px">
                                    <div class="active tab-pane" id="qaz">
                                        @foreach($document as $key => $item)
                                            <a style="font-size: 18px; margin-bottom: 10px" target="_blank" href="{{$item['doc_pdf_kz']}}">{{$key + 1}}. {{$item['doc_name_kz']}}</a></br>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="rus">
                                        @foreach($document as $key => $item)
                                            <a style="font-size: 18px; margin-bottom: 10px" target="_blank" href="{{$item['doc_pdf_ru']}}">{{$key + 1}}. {{$item['doc_name_ru']}}</a></br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection