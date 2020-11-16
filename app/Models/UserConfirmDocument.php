<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class UserConfirmDocument extends Model
{
    protected $table = 'user_confirm_document';
    protected $primaryKey = 'user_confirm_document_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
