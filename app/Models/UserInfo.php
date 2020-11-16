<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class UserInfo extends Model
{
    protected $table = 'user_info';
    protected $primaryKey = 'user_info_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
