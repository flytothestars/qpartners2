@extends('admin.layout.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="clear-float"></div>
                </div>

                <div class="box-body">

                    <div class="col-md-12">
                        <h3 class="box-title box-title-first">
                            <a class="menu-tab ">Пополнить баланс</a>
                        </h3>
                        <div class="form-group">
                            <label style="font-weight: 400; font-size: 18px">Ваша текущая сумма:
                                <b>{{Auth::user()->user_money}} $</b>
                                ({{Auth::user()->user_money * (\App\Models\Currency::where(['currency_id' => \App\Models\Currency::DOLLAR])->first())->money }}
                                тг)
                            </label>
                            </br>
                        </div>
                        <div class="form-group">
                            <label>Укажите сумму ($)</label>
                            <input id="balance" min="0" required value="" type="numeric" class="form-control"
                                   name="money" placeholder="Введите">
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-primary" onclick="addBalance()">Пополнить баланс
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection