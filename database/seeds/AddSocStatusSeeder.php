<?php

use Illuminate\Database\Seeder;

class AddSocStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserStatus::create([
            'user_status_id' => \App\Models\UserStatus::EMERALD_DIRECTOR,
            'user_status_name' => 'GAP Менеджер',
            'user_status_money' => 0,
            'user_status_available_level' => 0,
            'sort_num' => 110,
            'is_soc_status' => true,
            'is_show' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        \App\Models\UserStatus::create([
            'user_status_id' => \App\Models\UserStatus::DIAMOND_DIRECTOR,
            'user_status_name' => 'GAP Менеджер',
            'user_status_money' => 0,
            'user_status_available_level' => 0,
            'sort_num' => 110,
            'is_soc_status' => true,
            'is_show' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        \App\Models\UserStatus::create([
            'user_status_id' => \App\Models\UserStatus::GAP_MANAGER,
            'user_status_name' => 'GAP Менеджер',
            'user_status_money' => 0,
            'user_status_available_level' => 0,
            'sort_num' => 110,
            'is_soc_status' => true,
            'is_show' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        \App\Models\UserStatus::create([
            'user_status_id' => \App\Models\UserStatus::GAP1_MANAGER,
            'user_status_name' => 'GAP Менеджер 1ур',
            'user_status_money' => 0,
            'user_status_available_level' => 0,
            'sort_num' => 111,
            'is_soc_status' => true,
            'is_show' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        \App\Models\UserStatus::create([
            'user_status_id' => \App\Models\UserStatus::GAP2_MANAGER,
            'user_status_name' => 'GAP Менеджер 2ур',
            'user_status_money' => 0,
            'user_status_available_level' => 0,
            'sort_num' => 112,
            'is_soc_status' => true,
            'is_show' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        \App\Models\UserStatus::create([
            'user_status_id' => \App\Models\UserStatus::GAP3_MANAGER,
            'user_status_name' => 'GAP Менеджер 3ур',
            'user_status_money' => 0,
            'user_status_available_level' => 0,
            'sort_num' => 113,
            'is_soc_status' => true,
            'is_show' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        \App\Models\UserStatus::create([
            'user_status_id' => \App\Models\UserStatus::GAP4_MANAGER,
            'user_status_name' => 'GAP Менеджер 4ур',
            'user_status_money' => 0,
            'user_status_available_level' => 0,
            'sort_num' => 114,
            'is_soc_status' => true,
            'is_show' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        \App\Models\UserStatus::create([
            'user_status_id' => \App\Models\UserStatus::GAP5_MANAGER,
            'user_status_name' => 'GAP Менеджер 5ур',
            'user_status_money' => 0,
            'user_status_available_level' => 0,
            'sort_num' => 115,
            'is_soc_status' => true,
            'is_show' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        \App\Models\UserStatus::create([
            'user_status_id' => \App\Models\UserStatus::GAP6_MANAGER,
            'user_status_name' => 'GAP Менеджер 5ур',
            'user_status_money' => 0,
            'user_status_available_level' => 0,
            'sort_num' => 116,
            'is_soc_status' => true,
            'is_show' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        \App\Models\UserStatus::create([
            'user_status_id' => \App\Models\UserStatus::GAP7_MANAGER,
            'user_status_name' => 'GAP Менеджер 5ур',
            'user_status_money' => 0,
            'user_status_available_level' => 0,
            'sort_num' => 117,
            'is_soc_status' => true,
            'is_show' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        \App\Models\UserStatus::create([
            'user_status_id' => \App\Models\UserStatus::GAP8_MANAGER,
            'user_status_name' => 'GAP Менеджер 5ур',
            'user_status_money' => 0,
            'user_status_available_level' => 0,
            'sort_num' => 118,
            'is_soc_status' => true,
            'is_show' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
