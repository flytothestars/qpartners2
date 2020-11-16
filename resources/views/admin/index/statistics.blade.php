<section class="content-header">
    <h1>
        Статистика
    </h1>
</section>

<section class="content">
    <div class="row statistics-profile">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <?php $profit = \App\Models\Users::where('user_id',1)->sum('user_money'); ?>
                    <h3>{{round($profit,2)}}<sup style="font-size: 20px">$</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * $profit,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>Фонд компании</p>
                </div>
                <div class="icon"></div>
                <a href="#" class="small-box-footer">Доход</a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <?php $profit = \App\Models\UserPacket::where('is_active',1)->sum('packet_price'); ?>

                    <h3>{{round($profit,2)}}<sup style="font-size: 20px">$</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * $profit,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>Сумма всех пакетов</p>
                </div>
                <div class="icon">

                </div>
                <a href="#" class="small-box-footer">Доход</a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <?php $profit = \App\Models\Users::where('user_id','!=',1)->sum('user_money'); ?>

                    <h3>{{round($profit,2)}}<sup style="font-size: 20px">$</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * $profit,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>Сумма всех пользователей</p>
                </div>
                <div class="icon">

                </div>
                <a href="#" class="small-box-footer">Доход</a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <?php $profit = \App\Models\UserOperation::where('operation_id',2)
                            ->where('operation_type_id','=',12)
                            ->sum('money'); ?>

                    <h3>{{round($profit,2)}}<sup style="font-size: 20px">$</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * $profit,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>Снятая сумма пользователей</p>
                </div>
                <div class="icon"></div>
                <a href="#" class="small-box-footer">Доход</a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <?php $profit = \App\Models\UserOperation::where('operation_id',1)
                                                                    ->where('operation_type_id','=',1)
                                                                    ->sum('money'); ?>

                    <h3>{{round($profit,2)}}<sup style="font-size: 20px">$</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * $profit,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>Активный доход</p>
                </div>
                <div class="icon">

                </div>
                <a href="#" class="small-box-footer">Доход</a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <?php $profit = \App\Models\UserOperation::where('operation_id',1)
                            ->where('operation_type_id','=',14)
                            ->sum('money'); ?>

                    <h3>{{round($profit,2)}}<sup style="font-size: 20px">$</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * $profit,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>Ежемесячная активация</p>
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
                    <?php $profit = \App\Models\UserOperation::where('operation_id',1)
                            ->where('operation_type_id','=',10)
                            ->sum('money'); ?>

                    <h3>{{round($profit,2)}}<sup style="font-size: 20px">$</sup></h3>
                    <h2 style="margin-top: 0px">{{round($row->currency->money * $profit,2)}}<sup style="font-size: 20px">ТГ</sup></h2>
                    <p>Квалификация</p>
                </div>
                <div class="icon"></div>
                <a href="#" class="small-box-footer">Доход</a>
            </div>
        </div><!-- ./col -->
    </div>
</section>