<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    protected $fillable = ['review_text', 'review_type_id', 'user_id', 'rating', 'user_name', 'user_email'];

    const PRODUCT_REVIEW = 1;
    const NEWS_REVIEW = 2;

    public static function ratingCalculator($item_id, $review_type_id)
    {
        $rating = Review::where(['item_id' => $item_id])->where(['review_type_id' => $review_type_id])->get();

        if (!count($rating)) {
            return 0;
        }
        $rating = collect($rating)->all();
        $rating = array_map(function ($item) {
            return $item['rating'];
        }, $rating);

        $ratingSum = array_sum($rating);
        $ratingCount = count($rating);

        $rating = $ratingSum / $ratingCount;

        return intval(round($rating));
    }

    public function user()
    {
        return $this->hasOne('App\Models\Users', 'user_id', 'user_id');
    }
}
