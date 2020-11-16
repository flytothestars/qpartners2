<?php

use Illuminate\Database\Seeder;

class ChangeStatusNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserStatus::create([
            'user_status_id' => \App\Models\UserStatus::GAP8_MANAGER,
            'user_status_name' => 'GAP Менеджер 8ур',
            'user_status_money' => 0,
            'user_status_available_level' => 0,
            'sort_num' => 119,
            'is_soc_status' => true,
            'is_show' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        

        // \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::PREMIUM_MANAGER])->update(['user_status_name' => 'Premium Менеджер']);
        // \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::ELITE_MANAGER])->update(['user_status_name' => 'Elite Менеджер']);
        // \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::VIP_MANAGER])->update(['user_status_name' => 'VIP Менеджер']);
        // \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::BRONZE_MANAGER])->update(['user_status_name' => 'Бронзовый Менеджер']);
        // \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::SILVER_MANAGER])->update(['user_status_name' => 'Серебряный Менеджер']);
        // \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::GOLD_MANAGER])->update(['user_status_name' => 'Золотой Менеджер']);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::PLATINUM_MANAGER])->update(['user_status_name' => 'Платиновый Менеджер']);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::RUBIN_DIRECTOR])->update(['user_status_name' => 'Рубиновый Директор']);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::SAPPHIRE_DIRECTOR])->update(['user_status_name' => 'Сапфировый Директор']);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::EMERALD_DIRECTOR])->update(['user_status_name' => 'Изумрудный Директор']);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::DIAMOND_DIRECTOR])->update(['user_status_name' => 'Бриллиантовый Директор', 'is_soc_status' => false]);


        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::GAP_MANAGER])->update(['user_status_name' => 'GAP Менеджер', 'is_soc_status' => true]);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::GAP1_MANAGER])->update(['user_status_name' => 'GAP Менеджер 1ур', 'is_soc_status' => true]);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::GAP2_MANAGER])->update(['user_status_name' => 'GAP Менеджер 2ур', 'is_soc_status' => true]);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::GAP3_MANAGER])->update(['user_status_name' => 'GAP Менеджер 3ур', 'is_soc_status' => true]);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::GAP4_MANAGER])->update(['user_status_name' => 'GAP Менеджер 4ур', 'is_soc_status' => true]);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::GAP5_MANAGER])->update(['user_status_name' => 'GAP Менеджер 5ур', 'is_soc_status' => true]);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::GAP6_MANAGER])->update(['user_status_name' => 'GAP Менеджер 6ур', 'is_soc_status' => true]);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::GAP7_MANAGER])->update(['user_status_name' => 'GAP Менеджер 7ур', 'is_soc_status' => true]);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::GAP8_MANAGER])->update(['user_status_name' => 'GAP Менеджер 8ур', 'is_soc_status' => true]);

        
        \App\Models\Users::where(['soc_status_id' => \App\Models\UserStatus::DIAMOND_DIRECTOR])->update(['soc_status_id' => \App\Models\UserStatus::GAP_MANAGER]);
    }
}
