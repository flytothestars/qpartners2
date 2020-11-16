<?php $packet_list = \App\Models\UserPacket::leftJoin('packet','packet.packet_id','=','user_packet.packet_id')
                            ->where('user_id',$val->user_id)
                            ->where('is_active',1)
                            ->orderBy('packet.packet_id','asc')
                            ->get()?>

@foreach($packet_list as $key => $item)
    @if($item->packet_id > 1)
        <span class="label user-packet-span" style="background-color: #{{$item['packet_css_color']}}">{{$item['packet_name_ru']}}</span>
    @endif
@endforeach