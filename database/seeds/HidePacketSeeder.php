<?php

use Illuminate\Database\Seeder;

class HidePacketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Packet::where(['packet_id' => \App\Models\Packet::ELITE_FREE])->update(['is_portfolio' => 1]);
    }
}
