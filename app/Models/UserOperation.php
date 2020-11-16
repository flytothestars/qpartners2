<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class UserOperation extends Model
{
    protected $table = 'user_operation';
    protected $primaryKey = 'user_operation_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];



}
