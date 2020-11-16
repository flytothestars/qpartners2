<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class UserBasket extends Model
{
    protected $table = 'user_basket';
    protected $primaryKey = 'user_basket_id';
    
}
