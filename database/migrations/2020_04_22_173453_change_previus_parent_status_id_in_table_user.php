<?php

use App\Models\Users;
use App\Models\UserStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePreviusParentStatusIdInTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $parents = Users::all();
        foreach ($parents as $parent) {
            $parentFollowers = Users::parentFollowers($parent->user_id);
            $needNumber = 5; // Necessary number of followers for update parent status
            if (count($parentFollowers) >= $needNumber) {
                if ($parent->status_id == UserStatus::MANAGER && Users::isEnoughStatuses($parent->user_id, UserStatus::MANAGER)) {
                    $parent->status_id = UserStatus::BRONZE_MANAGER;
                }
                if ($parent->status_id == UserStatus::BRONZE_MANAGER && Users::isEnoughStatuses($parent->user_id, UserStatus::BRONZE_MANAGER)) {
                    $parent->status_id = UserStatus::SILVER_MANAGER;
                }
                if ($parent->status_id == UserStatus::SILVER_MANAGER && Users::isEnoughStatuses($parent->user_id, UserStatus::SILVER_MANAGER)) {
                    $parent->status_id = UserStatus::GOLD_MANAGER;
                }
                if ($parent->status_id == UserStatus::GOLD_MANAGER && Users::isEnoughStatuses($parent->user_id, UserStatus::GOLD_MANAGER)) {
                    $parent->status_id = UserStatus::SAPPHIRE_DIRECTOR;
                }
                if ($parent->status_id == UserStatus::SAPPHIRE_DIRECTOR && Users::isEnoughStatuses($parent->user_id, UserStatus::SAPPHIRE_DIRECTOR)) {
                    $parent->status_id = UserStatus::DIAMOND_DIRECTOR;
                }
                $parent->save();
            }
        }
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
