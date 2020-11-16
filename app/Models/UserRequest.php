<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class UserRequest extends Model
{
    protected $table = 'user_request';
    protected $primaryKey = 'user_request_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
