<?php $packet_list = \App\Models\UserPacket::leftJoin('packet','packet.packet_id','=','user_packet.packet_id')
                            ->where('user_id',$user->user_id)
                            ->where('is_active',1)
                            ->orderBy('packet.packet_id','asc')
                            ->get()?>

@foreach($packet_list as $key => $item)
    @if($item->packet_id > 1)
        <span title="{{$item['packet_name_ru']}}" style="float:none; background-color: #{{$item['packet_css_color']}}">{{$item['packet_name_ru']}}</span>
    @endif
@endforeach