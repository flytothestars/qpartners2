<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePaketStatusIdInTablePacket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('packet')
            ->where(['packet_id' => \App\Models\Packet::ELITE])
            ->update(['packet_status_id' => \App\Models\UserStatus::MANAGER]);
        DB::table('packet')
            ->where(['packet_id' => \App\Models\Packet::VIP])
            ->update(['packet_status_id' => \App\Models\UserStatus::SILVER_MANAGER]);
        DB::table('packet')
            ->where(['packet_id' => \App\Models\Packet::VIP2])
            ->update(['packet_status_id' => \App\Models\UserStatus::SILVER_MANAGER]);
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
