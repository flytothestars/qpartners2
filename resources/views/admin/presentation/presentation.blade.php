@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="box-header">
                        <h1 class="box-title main-title">
                            Презентация
                        </h1>
                        <div class="clear-float"></div>
                    </div>
                    <div class="nav-tabs-custom">
                        <div class="tab-content" >
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#qaz" data-toggle="tab">Маркетинг план</a>
                                    </li>
                                    <li>
                                        <a href="#rus" data-toggle="tab">
                                            Каталог продукции</a>
                                    </li>
                                </ul>
                                <div class="tab-content" style="min-height: 400px">
                                    <div class="active tab-pane" id="qaz">
                                        <iframe style="border:1px solid #666CCC" title="PDF in an i-Frame" src="/presentation/marketing_plan.pdf?v=1" frameborder="1" scrolling="auto" height="800" width="100%" ></iframe>
                                    </div>
                                    <div class="tab-pane" id="rus">
                                        <iframe style="border:1px solid #666CCC" title="PDF in an i-Frame" src="/presentation/normal_product.pdf?v=1" frameborder="1" scrolling="auto" height="800" width="100%" ></iframe>
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