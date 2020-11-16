<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class UserSubscribe extends Model
{
    protected $table = 'user_subscribe';
    protected $primaryKey = 'user_subscribe_id';
}
