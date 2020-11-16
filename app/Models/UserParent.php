<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class UserParent extends Model
{
    protected $table = 'user_parent';
    protected $primaryKey = 'user_parent_id';
}
