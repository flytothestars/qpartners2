<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminWebsite');
    }

    public function index(Request $request)
    {
        $row = News::where(function ($query) use ($request) {
            $query->where('news_name_kz', 'like', '%' . $request->search . '%')
                ->orWhere('news_name_ru', 'like', '%' . $request->search . '%')
                ->orWhere('news_name_en', 'like', '%' . $request->search . '%');
        })
            ->orderBy('news_id', 'desc')
            ->select('news.*',
                DB::raw('DATE_FORMAT(news.created_at,"%d.%m.%Y %H:%i") as date'));

        if (isset($request->active))
            $row->where('is_show', $request->active);
        else $row->where('is_show', '1');

        $row->where('news.parent_id', $request->parent_id);

        $row = $row->paginate(20);

        return view('admin.news.news', [
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new News();
        $row->news_image = '/media/default.png';
        $row->images = '/media/default_images.jpg';
        $row->news_date = date("d.m.Y H:i");
        return view('admin.news.news-edit', [
            'title' => 'Добавить новость',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'news_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.news.news-edit', [
                'title' => 'Добавить новость',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }


        $news = new News();
        $news->news_name_ru = $request->news_name_ru;
        $news->news_name_kz = $request->news_name_kz;
        $news->news_name_en = $request->news_name_en;
        $news->news_text_ru = $request->news_text_ru;
        $news->news_text_kz = $request->news_text_kz;
        $news->news_text_en = $request->news_text_en;
        $news->news_desc_ru = $request->news_desc_ru;
        $news->news_desc_kz = $request->news_desc_kz;
        $news->news_desc_en = $request->news_desc_en;
        $news->news_image = $request->news_image;
        $news->news_redirect = $request->news_redirect;
        $news->full_description_ru = $request->full_description_ru;
        $news->full_description_kz = $request->full_description_kz;


        $url = '';
        if ($request->parent_id == '') $request->parent_id = null;
        else {
            $level = News::where('news_id', $request->parent_id)->first();
            $level = $level->parent_level + 1;
            $news->parent_level = $level;
            $url = '?parent_id=' . $request->parent_id;
        }
        $news->parent_id = $request->parent_id;
        $timestamp = strtotime($request->news_date);
        $news->news_date = date("Y-m-d H:i", $timestamp);
        $news->save();

        if ($request->news_images) {
            $news_images = explode(',', $request->news_images[0]);
        }

        foreach ($news_images as $image) {
            $newsImages = new NewsImage();
            $newsImages->news_id = $news->news_id;
            $newsImages->path = $image;
            $newsImages->save();
        }


        return redirect('/admin/news' . $url);
    }


    public function edit($id)
    {
        $row = News::select('news.*',
            DB::raw('DATE_FORMAT(news.news_date,"%d.%m.%Y %H:%i") as news_date'))
            ->where('news.news_id', $id)
            ->first();

        $row->images = '/media/default_images.jpg';

        return view('admin.news.news-edit', [
            'title' => 'Изменить новость',
            'row' => $row
        ]);
    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'news_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.news.news-edit', [
                'title' => 'Изменить новость',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $news = News::find($id);
        $news->news_name_ru = $request->news_name_ru;
        $news->news_name_kz = $request->news_name_kz;
        $news->news_name_en = $request->news_name_en;
        $news->news_text_ru = $request->news_text_ru;
        $news->news_text_kz = $request->news_text_kz;
        $news->news_text_en = $request->news_text_en;
        $news->news_desc_ru = $request->news_desc_ru;
        $news->news_desc_kz = $request->news_desc_kz;
        $news->news_desc_en = $request->news_desc_en;
        $news->full_description_ru = $request->full_description_ru;
        $news->full_description_kz = $request->full_description_kz;
        $news->news_image = $request->news_image;
        $news->news_redirect = $request->news_redirect;
        $timestamp = strtotime($request->news_date);
        $news->news_date = date("Y-m-d H:i", $timestamp);
        if ($news->save()) {

            if ($request->news_images) {
                $news_images = explode(',', $request->news_images[0]);
            }
            foreach ($news_images as $image) {
                $newsImages = new NewsImage();
                $newsImages->news_id = $news->news_id;
                $newsImages->path = $image;
                $newsImages->save();
            }
        }

        if ($request->parent_id == '') $url = '';
        else $url = '?parent_id=' . $request->parent_id;

        return redirect('/admin/news' . $url);
    }

    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
    }

    public function changeIsShow(Request $request)
    {
        $news = News::find($request->id);
        $news->is_show = $request->is_show;
        $news->save();
    }
}
