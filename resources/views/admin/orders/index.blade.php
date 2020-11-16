<?php
use \App\Models\Currency;
?>
@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">


                <div class="box-body">
                    <div class="box-header">
                        <h1 class="box-title main-title">
                            Заказы
                        </h1>
                    </div>
                    <div class="nav-tabs-custom">

                        <div class="tab-content">
                            <div>
                                <form class="submit_form">
                                    <table id="news_datatable" class="table table-bordered table-striped table-css">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">№</th>
                                            <th>Пользователь</th>
                                            <th>Контакты</th>
                                            <th style="width: 150px">Адрес</th>
                                            <th style="width: 100px">Сумма</th>
                                            <th>Номер заказа</th>                                            
                                            <th>Оплачено</th>
                                            <th>Дата</th>
                                            <th>Детали</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        
                                            @foreach($row as $key => $val)
                                                <tr @if($val->is_paid == 1) style="background-color: #91ff91 !important;" @endif>
                                                    <td> {{ $key + 1 }}</td>
                                                    <td class="arial-font">
                                                        {{ $val->username }}
                                                    </td>
                                                    <td class="arial-font">
                                                        {{ $val->contact }}
                                                    </td>
                                                    <td class="arial-font">
                                                        {{ $val->address }}
                                                    </td>
                                                    <td class="arial-font">
                                                        {{ $val->sum }} тг
                                                    </td>
                                                    <td class="arial-font">
                                                        {{ $val->order_code }}
                                                    </td>                                              
                                                    <td class="arial-font">
                                                        @if ($val->is_paid)
                                                            ДА
                                                        @else
                                                            НЕТ
                                                        @endif                                                    
                                                    </td>
                                                    <td class="arial-font">
                                                    {{ $val->created_at }}
                                                    </td>
                                                    <td class="arial-font">
                                                        <a onclick="show_more_detail($(this))" data-toggle="modal" data-target="#order_form"  data-id="{{ htmlspecialchars(json_encode($val), ENT_QUOTES, 'UTF-8') }}" > Подробнее </a>    
                                                    </td>
                                                </tr>
                                            @endforeach                                       
                                        </tbody>
                                    </table>
                                </form>
                            </div>

                        </div>
                    </div>


                    <div style="text-align: center">
                        {{ $row->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
                    </div>

                </div>

                <div class="modal fade " id="order_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div style="top: 0%;" class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <div class="title-group"
                                     style="margin-left: 20px; font-size: 120%; color: black; font-weight: 400;">
                                    <h4 class="modal-title">Форма заявки</h4>                            
                                </div>
                            </div>
                            <div class="modal-body">
                                <form action="#">                                    
                                    <div class="form-group">
                                        <label for="username">ФИО</label>
                                        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" disabled >                              
                                    </div>
                                    <div class="form-group">
                                        <label for="contact">Контакт</label>
                                        <input type="text" class="form-control" id="contact" name="contact" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" disabled>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="address">Адрес</label>
                                        <input type="text" class="form-control" id="address" name="address" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="delivery">Доставка</label>
                                        <input type="text" class="form-control" id="delivery" name="delivery" disabled>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="payment_id">Номер транзакции</label>
                                        <input type="text" class="form-control" id="payment_id" name="payment_id" disabled>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="product">Продукты</label>
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Имя продукта</th>
                                                    <th scope="col">Кол-во</th>
                                                </tr>
                                            </thead>
                                            <tbody id="product_list">
                                                
                                            </tbody>
                                        </table>
                                    </div>                                    
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection 