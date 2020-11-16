<?php

use App\Models\UserStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusOfParent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $diamondStatuses = UserStatus::where(['user_status_id' => 28])->first();
        $diamondStatuses->user_status_id = 29;
        $diamondStatuses->sort_num = 108;
        $diamondStatuses->save();

        $userStatuses = new UserStatus();
        $userStatuses->user_status_id = 28;
        $userStatuses->user_status_name = 'Сапфировый директор';
        $userStatuses->user_status_money = 0;
        $userStatuses->sort_num = 107;
        $userStatuses->is_show = 1;
        $userStatuses->save();
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
