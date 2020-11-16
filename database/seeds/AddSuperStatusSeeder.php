<?php

use Illuminate\Database\Seeder;

class AddSuperStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserStatus::create([
            'user_status_id' => \App\Models\UserStatus::SUPER_MANAGER,
            'user_status_name' => 'SUPER Менеджер',
            'user_status_money' => 0,
            'user_status_available_level' => 0,
            'sort_num' => 0,
            'is_soc_status' => false,
            'is_show' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
