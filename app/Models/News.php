<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'news_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->hasOne('App\Models\Users', 'user_id', 'author_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\NewsImage', 'news_id', 'news_id');
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Review', 'item_id', 'news_id')->where(['review_type_id' => Review::NEWS_REVIEW]);
    }
}
