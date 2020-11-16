<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Instagram extends Model
{
    protected $table = 'instagram';
    protected $primaryKey = 'instagram_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
