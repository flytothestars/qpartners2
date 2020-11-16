<?php

use Illuminate\Database\Seeder;

class AddSuperPacketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Packet::create([
            'packet_id' => 31,
            'packet_name_ru' => 'Super',
            'packet_price' => 240,
            'is_show' => true,
            'sort_num' => 10,
            'packet_css_color' => '00bfff',
            'packet_available_level' => 4,
            'packet_desc_ru' => 'Здесь будет подробнее описание пакета',
            'packet_thing' => '',
            'packet_lection' => '',
            'packet_status_id' => \App\Models\UserStatus::SUPER_MANAGER,
            'is_upgrade_packet' => false,
        ]);
    }
}
