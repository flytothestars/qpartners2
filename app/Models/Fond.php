<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Fond extends Model
{
    protected $table = 'fond';
    protected $primaryKey = 'fond_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    const GLOBAL_DIAMOND_FOUND = 4;
}
