<?php

use App\Models\Packet;
use \Illuminate\Support\Facades\Auth;
use \App\Models\UserPacket;

?>

@foreach($row->packet as $key => $item)

    @if($item->is_portfolio == 0)

        <?php 
            $beforeSum = 0;
            $actualPackets = [Packet::PREMIUM, Packet::ELITE, Packet::VIP2];
        ?>        
        @if(!in_array($item->packet_id, [\App\Models\Packet::GAP2, \App\Models\Packet::GAP1]))
            <?php $beforeSum = UserPacket::beforePurchaseSumWithPacketId(Auth::user()->user_id, $item->packet_id) ?>
        @endif


        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box packet-item-list" style="background-color: #{{$item->packet_css_color}}">
                <div class="inner">
                    <h3 style="font-family: cursive; font-size: 30px"> {{$item->packet_name_ru}}</h3>

                    <h4 style="font-size: 25px">
                        @if ($item->packet_id == \App\Models\Packet::GAP || $item->packet_id == \App\Models\Packet::SUPER)                       
                            {{($item->packet_price) * \App\Models\Currency::pvToKzt()}} тг       
                        @else
                            {{($item->packet_price - $beforeSum) * \App\Models\Currency::pvToKzt()}} тг
                        @endif
                    </h4>

                    @if($packet_type == 'share')
                        @if($item->packet_share > 0)
                            <h4 style="font-size: 22px; font-weight: 800">{{$item->packet_share}} доля</h4>
                        @else
                            <h4 style="font-size: 22px; font-weight: 800">&ensp;</h4>
                        @endif
                    @elseif($packet_type == 'item')
                        <h4 style="font-size: 22px; font-weight: 800">{{$item->packet_thing}}</h4>
                    @elseif($packet_type == 'service')
                        <h4 style="font-size: 22px; font-weight: 800">{{$item->packet_lection}}</h4>
                    @endif

                    <input class="packet_type" type="hidden" value="{{$packet_type}}"/>
                </div>
                <div class="icon">
                    <i class="ion ion-bag" style="font-size: 40px"></i>
                </div>

                {{--@if(($item->has_packet > 0 && $item->is_active > 0) || $max_packet_user_number[$item->is_portfolio] == null || $max_packet_user_number[$item->is_portfolio]->packet_id <= $item->packet_id)--}}
                @if($item->has_packet > 0)
                    @if($item->is_active > 0)
                        <a class="small-box-footer shop_buy_btn" style="font-size: 18px">Вы уже приобрели</a>
                    @else
                        <a href="javascript:void(0)" onclick="cancelResponsePacket(this,'{{$item->packet_id}}')"
                           class="small-box-footer shop_buy_btn" style="font-size: 18px">Отменить запрос <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    @endif 
                @else                    
                    @if ($item->packet_id == Packet::GAP)
                        @if ($max_packet_user_number[0] == null || ($max_packet_user_number[0] != null && !in_array($max_packet_user_number[0]->packet_id, $actualPackets)))
                            <a href="javascript:void(0)" onclick="showLimitMessage()"
                                class="buy_btn_{{$item->packet_id}} small-box-footer shop_buy_btn" style="font-size: 18px">Купить
                                пакет <i class="fa fa-arrow-circle-right"></i></a>
                        @else
                            <a href="javascript:void(0)" onclick="showBuyModal(this,'{{$item->packet_id}}')"
                                class="buy_btn_{{$item->packet_id}} small-box-footer shop_buy_btn" style="font-size: 18px">Купить
                                пакет <i class="fa fa-arrow-circle-right"></i></a>    
                        @endif                        
                    @else
                        <a href="javascript:void(0)" onclick="showBuyModal(this,'{{$item->packet_id}}')"
                            class="buy_btn_{{$item->packet_id}} small-box-footer shop_buy_btn" style="font-size: 18px">Купить
                            пакет <i class="fa fa-arrow-circle-right"></i></a>
                    @endif
                @endif
                {{--@else

                    <a class="small-box-footer" style="font-size: 18px">&ensp;</a>

                @endif--}}

                <a href="javascript:void(0)" onclick="getReadMorePacket('{{$item->packet_id}}')"
                   class="small-box-footer"
                   style="font-size: 16px; text-decoration: underline; padding-top: 10px; background: rgba(0, 0, 0, 0.21) none repeat scroll 0px 0px;">Подробнее</a>
            </div>
        </div>

    @endif

@endforeach
