<section class="content-header">
    <h1>
        Текущий счет
    </h1>
</section>

<section class="content">
    <div class="row statistics-profile">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{round(Auth::user()->user_money,2)}}<sup style="font-size: 20px">pv</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * Auth::user()->user_money,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>Текущий баланс</p>
                </div>
                <div class="icon">

                </div>
                <a href="#" class="small-box-footer">Баланс</a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-gray">
                <div class="inner">
                    <h3>{{round($row->out_money,2)}}<sup style="font-size: 20px">pv</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * $row->out_money,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>Сумма, которая была снята</p>
                </div>
                <div class="icon">

                </div>
                <a href="#" class="small-box-footer">Баланс</a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-gray">
                <div class="inner">
                    <h3>{{round($row->send_money,2)}}<sup style="font-size: 20px">pv</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * $row->send_money,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>Сумма, которая была отправлена</p>
                </div>
                <div class="icon">

                </div>
                <a href="#" class="small-box-footer">Баланс</a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{round($row->profit_all + $row->passive_profit_all,2)}}<sup style="font-size: 20px">pv</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * ($row->profit_all + $row->passive_profit_all),2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>За весь период</p>
                </div>
                <div class="icon">

                </div>
                <a href="#" class="small-box-footer">Доход</a>
            </div>
        </div><!-- ./col -->
        <div style="clear: both"></div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>{{$row->currency->money}}<sup style="font-size: 20px">Тенге</sup></h3>
                    <h2 style="margin-top: 0px">&nbsp;<sup style="font-size: 20px">&nbsp;</sup></h2>
                    <p>1 pv = {{$row->currency->money}} т.г. </p>
                </div>
                <div class="icon">

                </div>
                <a href="#" class="small-box-footer">Курс</a>
            </div>
        </div><!-- ./col -->

    </div>
</section>