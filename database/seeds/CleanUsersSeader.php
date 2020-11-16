<?php

use Illuminate\Database\Seeder;

class CleanUsersSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('users')->truncate();
        DB::table('user_info')->truncate();
        DB::table('user_document')->truncate();
        DB::table('user_confirm_document')->truncate();
        DB::table('user_group')->truncate();
        DB::table('user_basket')->truncate();
        DB::table('user_operation')->truncate();
        DB::table('user_packet')->truncate();

        \App\Models\Users::create(
        [
            'user_id' => 1,
            'name' => 'Admin',
            'phone' => +77716742555,
            'email' => 'admin.kz@gmail.com',
            'avatar' => '/media/default.png',
            'role_id' => 1,
            'is_interest_holder' => 0,
            'share' => 0,
            'password' => Hash::make('qnatural2021'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'remember_token' => '',
            'is_ban' => 0,
            'last_name' => 'Админ',
            'middle_name' => '',
            'recommend_user_id' => null,
            'city_id' => 2,
            'user_money' => 0,
            'office_director_id' => null,
            'login' => 'admin',
            'office_name' => '',
            'hash_email' => '',
            'is_confirm_email' => 1,
            'status_id' => null,
            'is_activated' => 1,
            'activated_date' => date('Y-m-d H:i:s'),
            'parent_id' => null,
            'instagram' => '',

        ]
        );
    }
}
