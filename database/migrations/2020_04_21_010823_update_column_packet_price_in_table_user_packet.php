<?php

use App\Models\UserPacket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnPacketPriceInTableUserPacket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $classicUserPacket = UserPacket::where(['packet_id' => 23])->get();
        $premiumUserPacket = UserPacket::where(['packet_id' => 24])->get();
        $eliteUserPacket = UserPacket::where(['packet_id' => 25])->get();
        $vipUserPacket = UserPacket::where(['packet_id' => 26])->get();
        $vipUserPacket2 = UserPacket::where(['packet_id' => 27])->get();
        $GAP1UserPacket = UserPacket::where(['packet_id' => 28])->get();
        $GAP2UserPacket = UserPacket::where(['packet_id' => 29])->get();

        /** @var UserPacket $userPacket */
        foreach ($classicUserPacket as $userPacket) {
            $userPacket->packet_price = 10;
            $userPacket->save();
        }

        /** @var UserPacket $premiumPacket */
        foreach ($premiumUserPacket as $premiumPacket) {
            $premiumPacket->packet_price = 50;
            $premiumPacket->save();
        }

        /** @var UserPacket $elitePacket */
        foreach ($eliteUserPacket as $elitePacket) {
            $elitePacket->packet_price = 100;
            $elitePacket->save();
        }
        foreach ($vipUserPacket as $vipPacket) {
            $vipPacket->packet_price = 400;
            $vipPacket->save();
        }
        foreach ($vipUserPacket2 as $vipPacket) {
            $vipPacket->packet_price = 400;
            $vipPacket->save();
        }
        foreach ($GAP1UserPacket as $gap1Packet) {
            $gap1Packet->packet_price = 100;
            $gap1Packet->save();
        }
        foreach ($GAP2UserPacket as $gap2Packet) {
            $gap2Packet->packet_price = 200;
            $gap2Packet->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
