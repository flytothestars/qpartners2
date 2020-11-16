<div class="box-body">
    <table id="packet_datatable" class="table table-bordered table-striped">
        <thead>
        <tr style="border: 1px">
            <th style="width: 30px">№</th>
            <th></th>
            <th>Название</th>
            <th>Количество</th>
            <th>Цена</th>
            <th>Балл</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <tbody>
        <?php $sum = 0; ?>
        <?php $ballSum = 0; ?>

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
                    <input class="basket_product_id" type="hidden" value="{{ $val->product_id }}"/>
                    <input onchange="setBasketUnit(this,'{{ $val->product_id }}')" placeholder="Количество"
                           style="padding: 3px 10px" class="basket_product_unit" type="number"
                           value="{{ $val->unit }}"/>
                </td>
                <td>
                    @php
                        if($row->is_packet) {
                            $price_ball = $val->product_price - ($val->product_price * \App\Models\Currency::PacketDiscount);
                        }
                        else if ($row->is_partner) {
                            $price_ball = $val->product_price - ($val->product_price * \App\Models\Currency::PartnerDiscount);
                        }
                        else {
                            $price_ball = $val->product_price - ($val->product_price * \App\Models\Currency::ClientDiscount);
                        }
                    @endphp
                    {{ round($price_ball, 2) }}$
                    ({{round($price_ball * \App\Models\Currency::pvToKzt(),0)}}
                    тг)
                </td>
                <td>
                    {{ $val['ball'] }}
                </td>
                <td style="text-align: center">
                    <a href="javascript:void(0)" onclick="delProductFromBasket(this,'{{ $val->product_id }}')">
                        <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                    </a>
                </td>
            </tr>

            <?php $sum += round($price_ball, 2); ?>
            <?php $ballSum += $val->ball ?>

        @endforeach

        <tr>
            <td colspan="4" style="text-align: right"><b>Общая сумма:</b></td>
            <td colspan="1"><b id="sum">{{$sum}} $
                    ({{round($sum * \App\Models\Currency::pvToKzt(),0)}}тг)</b>
            </td>
            <td colspan="1"><b id="ballSum">+ {{ $ballSum }}</b>
            </td>
            <td></td>
        <tr>
            <td colspan="7" style="text-align: right">
                <a href="javascript:void(0)" onclick="showBasketModal()" class="btn btn-primary btn-block"
                   style="background-color: rgb(253, 58, 53) !important; width: 200px"><b>Подтвердить заказ</b></a>
            </td>
        </tr>

        </tbody>

    </table>


</div>