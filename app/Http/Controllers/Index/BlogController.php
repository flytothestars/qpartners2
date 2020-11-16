<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class BlogController extends Controller
{
    public function getBlogList()
    {
        $row = Blog::where('is_show',1)
            ->orderByRaw("RAND()")
            ->paginate(20);

        return  view('index.blog.blog',
            [
                'menu' => 'news',
                'row' => $row,
                'title' => 'Полезные статьи',
                'meta_description' => 'Полезные статьи. Trade logistic KZ'
            ]
        );
    }

    public function getBlogById($url)
    {
        $id = Helpers::getIdFromUrl($url);

        $row = Blog::where('is_show',1)->where('blog_id',$id)->first();

        if($row == null)
            return response()->view('errors.404', [], 404);
        
        return  view('index.blog.blog-detail',
            [
                'menu' => 'blog',
                'row' => $row,
                'title' => $row->blog_name_ru,
                'meta_description' => $row->blog_name_ru .'. Trade logistic KZ'
            ]
        );
    }
}
