<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Country extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'country_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
