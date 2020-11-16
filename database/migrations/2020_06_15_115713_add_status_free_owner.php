<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusFreeOwner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('user_status')->where(['user_status_id' => 20])->update([
            'user_status_name' => 'Владелец Elite free',
            'user_status_money' => 0,
            'user_status_share' => 0,
            'user_status_available_level' => 0,
            'user_status_minimum_money' => 0,
            'user_status_binar_procent' => 0,
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
