<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Carriage extends Model
{
    protected $table = 'carriage';
    protected $primaryKey = 'carriage_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
