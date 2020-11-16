<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Page extends Model
{
    protected $table = 'page';
    protected $primaryKey = 'page_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
