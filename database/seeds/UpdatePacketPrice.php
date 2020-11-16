<?php

use Illuminate\Database\Seeder;

class UpdatePacketPrice extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Packet::where(['packet_id' => \App\Models\Packet::CLASSIC])->update(['packet_price' => 50]);
        \App\Models\Packet::where(['packet_id' => \App\Models\Packet::PREMIUM])->update(['packet_price' => 100]);
        \App\Models\Packet::where(['packet_id' => \App\Models\Packet::ELITE])->update(['packet_price' => 200]);
        \App\Models\Packet::where(['packet_id' => \App\Models\Packet::VIP2])->update(['packet_price' => 300]);
        \App\Models\Packet::where(['packet_id' => \App\Models\Packet::GAP])->update(['packet_price' => 300]);
    }
}
