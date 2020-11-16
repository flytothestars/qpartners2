<?php

use Illuminate\Database\Seeder;

class ChangeUserSocStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::EMERALD_DIRECTOR])->update(['is_soc_status' => false]);
        \App\Models\UserStatus::where(['user_status_id' => \App\Models\UserStatus::DIAMOND_DIRECTOR])->update(['is_soc_status' => false]);
    }
}
