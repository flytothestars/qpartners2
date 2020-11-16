<?php

use Illuminate\Database\Seeder;

class UpdatePacketAvailableLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Packet::where(['packet_id' => \App\Models\Packet::CLASSIC])->update(['packet_available_level' => 4]);
        \App\Models\Packet::where(['packet_id' => \App\Models\Packet::PREMIUM])->update(['packet_available_level' => 4]);
        \App\Models\Packet::where(['packet_id' => \App\Models\Packet::ELITE])->update(['packet_available_level' => 6]);
        \App\Models\Packet::where(['packet_id' => \App\Models\Packet::VIP2])->update(['packet_available_level' => 8]);

        \App\Models\Packet::where(['packet_id' => \App\Models\Packet::GAP])->update(['packet_status_id' => 34, 'packet_name_ru' => 'GAP']);
    }
}
