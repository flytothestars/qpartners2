@foreach($row->products as $key => $item)

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <div style="padding: 10px">
                <a href="{{$item->product_image}}" class="fancybox" rel="{{$key}}">
                    <img style="width: 100%; border-radius: 5px" src="{{$item->product_image}}"/>
                </a>
            </div>
            <div class="info-box-content" style="margin-left: 0px; text-align: center; padding-bottom: 14px">
                <span class="info-box-text" style="font-weight: bold; color: red">{{$item->product_name_ru}}</span>
                @php
                    if($row->is_packet) {
                        $price_ball = $item->product_price - ($item->product_price * \App\Models\Currency::PacketDiscount);
                    }
                    else if ($row->is_partner) {
                        $price_ball = $item->product_price - ($item->product_price * \App\Models\Currency::PartnerDiscount);
                    }
                    else {
                        $price_ball = $item->product_price - ($item->product_price * \App\Models\Currency::ClientDiscount);
                    }
                @endphp
                @php
                    $price = $price_ball * \App\Models\Currency::pvToKzt();
                @endphp
                <span class="info-box-number">{{$price_ball}}$ ({{round($price)}}тг)</span>
                <a style="text-decoration: underline" href="javascript:void(0)" onclick="getReadMoreProduct(this)">Подробнее</a>
                <span class="info-box-desc" style="display: none">{{$item->product_desc_ru}}</span>
                <div class="text-center" style="margin-top: 5px">
                    <input onclick="addProductToBasket('{{$item->product_id}}')"
                           style="border:none; background-color: #00BDE7; border-radius: 5px; padding: 4px 10px"
                           type="button" value="Добавить в корзину"/>
                </div>
            </div>
        </div>
    </div>

@endforeach


