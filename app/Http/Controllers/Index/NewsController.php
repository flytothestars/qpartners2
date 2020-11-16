<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class NewsController extends Controller
{
    public function newsList(Request $request)
    {

        $category_id = $request->input('category_id');

        $news = News::where('is_show', 1);
        if ($category_id) {
            $news = $news->where(['category_id' => $category_id]);
        }
        $news = $news->orderBy('news_date', 'desc')
            ->paginate(6);

        $categories = NewsCategory::where(['is_active' => true])->get();


        return view('design_index.news.news-list',
            [
                'menu' => 'news',
                'news' => $news,
                'categories' => $categories,
            ]
        );
    }

    public function getNewsById($id)
    {
        $row = News::where('is_show', 1)->where('news_id', $id)->first();
        $categories = NewsCategory::where(['is_active' => true])->get();
        $news = News::where('is_show', 1)
            ->orderBy('news_date', 'desc')
            ->paginate(6);
        $comments = Review::where(['item_id' => $id])->where(['review_type_id' => Review::NEWS_REVIEW])->get();


        if ($row == null)
            return response()->view('errors.404', [], 404);

        $images = $row->images;
        $author = $row->user;

        return view('design_index.news.news-detail',
            [
                'menu' => 'news',
                'popular_news' => $news,
                'news' => $row,
                'comments' => $comments,
                'author' => $author,
                'images' => $images,
                'title' => $row->news_name_ru,
                'categories' => $categories,
                'meta_description' => $row->news_name_ru . '. QazaqTurizm'
            ]
        );
    }
}
