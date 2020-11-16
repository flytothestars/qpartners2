<?php

namespace App\Models;

use http\Client\Curl\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $primaryKey = 'user_id';
    protected $fillable = ['email', 'password', 'login', 'user_id'];

    const ADMIN = 1;
    const CLIENT = 2;
    const MODERATOR = 3;

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public static function parentFollowers($parent_id)
    {
        return Users::where(['recommend_user_id' => $parent_id])->get();
    }

    public static function isEnoughStatuses($parent_id, $status_id, $status_type)
    {
        $followerStatusIds = [];
        $followers = Users::where(['recommend_user_id' => $parent_id])->get();

        foreach ($followers as $follower) {
            if ($status_type == 1) {
                if ($follower->status_id >= $status_id) {
                    array_push($followerStatusIds, $follower->status_id);
                }
            }
            elseif ($status_type == 2) {
                if ($follower->soc_status_id >= $status_id) {
                    array_push($followerStatusIds, $follower->soc_status_id);
                }
            }
            elseif ($status_type == 3) {
                if ($follower->super_status_id >= $status_id) {
                    array_push($followerStatusIds, $follower->super_status_id);
                }
            }
        }
        $followerStatusIds = array_filter($followerStatusIds);
        if (count($followerStatusIds) >= 3) {
            return true;
        }
        return false;
    }
}
