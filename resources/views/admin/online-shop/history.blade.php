@extends('admin.layout.layout')

@section('breadcrump')

    <section class="content-header">
        <h1>
            История покупок
        </h1>

        <div style="text-align: right">
            <a style="font-size: 20px;text-decoration: underline;" href="/admin/online">Перейти в магазин<span id="basket_count" class="label label-primary pull-right" style=" background-color: rgb(253, 58, 53) ! important; font-size: 15px; border-radius: 50%">{{$row->basket_count}}</span></a>
        </div>
    </section>

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <h2 class="page-header">История покупок</h2>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="packet_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th></th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Дата</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php $sum = 0; ?>

                        @foreach($row->basket as $key => $val)

                            <tr>
                                <td> {{ $key + 1 }}</td>
                                <td>
                                    <div class="object-image">
                                        <a class="fancybox" href="{{$val->product_image}}">
                                            <img src="{{$val->product_image}}">
                                        </a>
                                    </div>
                                    <div class="clear-float"></div>
                                </td>
                                <td>
                                    {{ $val['product_name_ru']}}
                                </td>
                                <td>
                                    {{ $val['product_price']}}$ ({{round($val->product_price * \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}тг)
                                </td>
                                <td>
                                    {{ $val['unit']}}
                                </td>
                                <td style="text-align: center">
                                    {{ $val['date']}}
                                </td>
                            </tr>

                            <?php $sum += $val->product_price; ?>

                        @endforeach

                        <tr>
                            <td colspan="5" style="text-align: right"><b>Общая сумма:</b> </td>
                            <td colspan="1"><b id="sum">{{$sum}}$ ({{round($sum * \App\Models\Currency::where('currency_name','тенге')->first()->money,2)}}тг)</b></td>
                        </tr>


                        </tbody>

                    </table>



                </div>
            </div>
        </div>
    </div>



@endsection


