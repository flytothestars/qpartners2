<?php

use App\Models\Packet;
use App\Models\UserPacket;
use App\Models\Users;
use App\Models\UserStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusIdInTbalePacket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->changeStatusId(Packet::CLASSIC, UserStatus::CONSULTANT);
        $this->changeStatusId(Packet::PREMIUM, UserStatus::AGENT);
        $this->changeStatusId(Packet::ELITE, UserStatus::MANAGER);
        $this->changeStatusId(Packet::VIP2, UserStatus::MANAGER);

        // correct all previous status id in users
        $this->correctAllStatusesId();
    }

    public function changeStatusId($packet_id, $status_id)
    {
        /** @var Packet $classicPacket */
        $classicPacket = Packet::where(['packet_id' => $packet_id])->first();
        $classicPacket->packet_status_id = $status_id;
        $classicPacket->save();
    }

    public function correctAllStatusesId()
    {
        $users = Users::all();
        $needPacketIds = [23, 24, 25, 26, 27];
        foreach ($users as $user) {
            $maxUserPacketIds = UserPacket::where(['user_id' => $user->user_id])
                ->whereIn('packet_id', $needPacketIds)
                ->get();

            $maxUserPacketIds = array_map(function ($packet) {
                return $packet['packet_id'];
            }, $maxUserPacketIds->toArray());


            if (!empty($maxUserPacketIds)) {
                $maxUserPacketId = max($maxUserPacketIds);
                if ($maxUserPacketId == Packet::CLASSIC) {
                    $status_id = UserStatus::CONSULTANT;
                } elseif ($maxUserPacketId == Packet::PREMIUM) {
                    $status_id = UserStatus::AGENT;
                } elseif ($maxUserPacketId == Packet::ELITE) {
                    $status_id = UserStatus::MANAGER;
                } elseif ($maxUserPacketId == Packet::VIP) {
                    $status_id = UserStatus::MANAGER;
                } elseif ($maxUserPacketId == Packet::VIP2) {
                    $status_id = UserStatus::MANAGER;
                } else {
                    $user->status_id = NULL;
                }
                $user->status_id = $status_id;
            } else {
                $user->status_id = NULL;
            }
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public
    function down()
    {
        //
    }
}
