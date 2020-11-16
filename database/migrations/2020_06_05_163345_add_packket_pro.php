<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPackketPro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('packet')->insert([
            'packet_id' => 30,
            'packet_name_ru' => 'PRO',
            'packet_image' => '/media/2018/11/27/Hydrangeas.jpg',
            'packet_price' => 1000,
            'is_show' => 1,
            'sort_num' => 6,
            'packet_url' => 'pro',
            'packet_css_color' => 'ffdf00',
            'packet_available_level' => 5,
            'packet_desc_ru' => 'Здесь будет подробнее описание пакета',
            'packet_thing' => 'Обучение Qyran ACADEMY + 10 Продукт + 30 PRO Продукт + Back office',
            'packet_lection' => 'Тренинги',
            'packet_status_id' => \App\Models\UserStatus::GOLD_DIRECTOR,
            'office_procent' => 0,
            'packet_type' => 1,
            'is_recruite_profit' => 1,
            'is_usual_packet' => 1,
            'is_upgrade_packet' => 1,
            'pv' => 1000,
            'upgrade_type' => 3,
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
