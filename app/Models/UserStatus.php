<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class UserStatus extends Model
{
    protected $table = 'user_status';
    protected $primaryKey = 'user_status_id';
    
    const SUPER_MANAGER = 43;
    
    const FREE_ELITE_OWNER = 20;
    const CLIENT = 21;
    const CONSULTANT = 22;
    const PREMIUM_MANAGER = 23;
    const ELITE_MANAGER = 24;
    const VIP_MANAGER = 25;
    const BRONZE_MANAGER = 26;
    const SILVER_MANAGER = 27;
    const GOLD_MANAGER = 28;
    const PLATINUM_MANAGER = 29;
    const RUBIN_DIRECTOR = 30;
    const SAPPHIRE_DIRECTOR = 31;
    const EMERALD_DIRECTOR = 32;
    const DIAMOND_DIRECTOR = 33;

    const GAP_MANAGER = 34;
    const GAP1_MANAGER = 35;
    const GAP2_MANAGER = 36;
    const GAP3_MANAGER = 37;
    const GAP4_MANAGER = 38;
    const GAP5_MANAGER = 39;
    const GAP6_MANAGER = 40;
    const GAP7_MANAGER = 41;
    const GAP8_MANAGER = 42;


    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public static function getStatusName($id)
    {
        $statusName = UserStatus::where(['user_status_id' => $id])->first();
        $statusName = $statusName ? $statusName->user_status_name : NULL;
        return $statusName;
    }
}
