<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Support\Arr;

class UserPacket extends Model
{


    protected $table = 'user_packet';
    protected $primaryKey = 'user_packet_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function packet()
    {
        return $this->belongsTo('App\Models\Packet');
    }

    public static function getLessElementsSum($array, $index)
    {
        $counter = 0;
        $sum = 0;
        while ($counter < $index) {
            $sum += $array[$counter];
            $counter++;
        }

        return $sum;
    }

    public static function beforePurchaseSum($user_id)
    {

        $userPackets = UserPacket::where(['user_packet.user_id' => $user_id])->where('user_packet.is_active', 1)
            ->join('packet', 'packet.packet_id', '=', 'user_packet.packet_id')
            ->whereIn('user_packet.packet_id', Packet::actualPacket())
            ->get()->sortBy('packet.packet_id');

        if (!count($userPackets)) {
            return 0;
        };


        $userPackets = collect($userPackets);
        $userPackets = Arr::pluck($userPackets, 'packet.packet_price', 'packet.packet_id');
        $counter = 0;
        $array = [];
        foreach ($userPackets as $key => $value) {
            if (empty($array)) {
                $array[$counter] = $value;
            } else {
                $lessElementsSum = self::getLessElementsSum($array, $counter);
                $lessElementsSum = $value - $lessElementsSum;
                $array[$counter] = $lessElementsSum;
            }
            $counter++;
        }
        return array_sum($array);

    }

    public static function beforePurchaseSumWithPacketId($user_id, $packet_id)
    {
        $userPackets = UserPacket::where(['user_packet.user_id' => $user_id])->where('user_packet.is_active', 1)
            ->join('packet', 'packet.packet_id', '=', 'user_packet.packet_id')
            ->where('user_packet.packet_id', '<', $packet_id);

        $userPackets = $userPackets->whereIn('user_packet.packet_id', Packet::actualPacket());
        $userPackets = $userPackets->get()->sortBy('packet.packet_id');

        if (!count($userPackets)) {
            return 0;
        };


        $userPackets = collect($userPackets);
        $userPackets = Arr::pluck($userPackets, 'packet.packet_price', 'packet.packet_id');
        $counter = 0;
        $array = [];
        foreach ($userPackets as $key => $value) {
            if (empty($array)) {
                $array[$counter] = $value;
            } else {
                $lessElementsSum = self::getLessElementsSum($array, $counter);
                $lessElementsSum = $value - $lessElementsSum;
                $array[$counter] = $lessElementsSum;
            }
            $counter++;
        }
        return array_sum($array);

    }


}