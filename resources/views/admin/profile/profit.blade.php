<div class="col-md-6">
    <div class="profile-profit">
        <p><b class="title">Доход</b></p>
        <p><b>На сегодня:</b> {{round($row->profit_today,2)}} $</p>
        <p><b>За последнюю неделю:</b> {{round($row->profit_last_week,2)}} $</p>
        <p><b>За последний месяц:</b> {{round($row->profit_last_month,2)}} $</p>
        <p><b>За весь период:</b> {{round($row->profit_all,2)}} $</p>
        <p><b>Акционерная доля:</b> {{$row->user_share}}</p>
    </div>
</div>
<div class="col-md-6">
    <div class="profile-profit">
        <p><b class="title">Долевой фонд</b></p>
        <p><b>Дольщики:</b> {{$row->shareholder_count}}</p>
        <p><b>Поступления на сегодня:</b> {{round($row->shareholder_profit_today,2)}} $</p>
        <p><b>Средний чек:</b> {{round($row->shareholder_average_mount,2)}} $</p>
        <p><b>Курс:</b> {{$row->currency->money}} тг.</p>
    </div>
</div>