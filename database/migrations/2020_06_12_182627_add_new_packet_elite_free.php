<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewPacketEliteFree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('packet')->where(['packet_id' => 22])->delete();
        DB::table('packet')->insert([
            'packet_id' => 22,
            'packet_name_ru' => 'Elite Free',
            'packet_image' => '/media/2018/11/27/Hydrangeas.jpg',
            'packet_price' => 0,
            'is_show' => 1,
            'sort_num' => 7,
            'packet_url' => 'elite free',
            'packet_css_color' => '6EE906 ',
            'packet_available_level' => 0,
            'packet_desc_ru' => 'Здесь будет подробнее описание пакета',
            'packet_thing' => 'Back office',
            'packet_lection' => '',
            'packet_status_id' => \App\Models\UserStatus::FREE_ELITE_OWNER,
            'office_procent' => 0,
            'packet_type' => 1,
            'is_recruite_profit' => 1,
            'is_usual_packet' => 1,
            'is_upgrade_packet' => 1,
            'pv' => 0,
            'upgrade_type' => 1,
        ]);
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

