<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class User2 extends Model
{
    protected $table = 'user2';
    protected $primaryKey = 'id';
}
