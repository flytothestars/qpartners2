<section class="content-header">
    <h1>
        Накопительный бонус
    </h1>
</section>

<section class="content">

    <div class="row statistics-profile">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{round($row->home_profit_today,2)}}<sup style="font-size: 20px">pv</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * $row->home_profit_today,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>На сегодня</p>
                </div>
                <div class="icon">

                </div>
                <a href="#" class="small-box-footer">Доход</a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{round($row->home_profit_last_week,2)}}<sup style="font-size: 20px">pv</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * $row->home_profit_last_week,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>За последнюю неделю</p>
                </div>
                <div class="icon">

                </div>
                <a href="#" class="small-box-footer">Доход</a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{round($row->home_profit_last_month,2)}}<sup style="font-size: 20px">pv</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * $row->home_profit_last_month,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>За последний месяц</p>
                </div>
                <div class="icon">

                </div>
                <a href="#" class="small-box-footer">Доход</a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{round($row->home_profit_all,2)}}<sup style="font-size: 20px">pv</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * $row->home_profit_all,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>За весь период</p>
                </div>
                <div class="icon">

                </div>
                <a href="#" class="small-box-footer">Доход</a>
            </div>
        </div><!-- ./col -->


    </div>
</section>