<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminWebsite');
    }

    public function index(Request $request)
    {
        $row = Blog::where(function($query) use ($request){
            $query->where('blog_name_kz','like','%' .$request->search .'%')
                ->orWhere('blog_name_ru','like','%' .$request->search .'%')
                ->orWhere('blog_name_en','like','%' .$request->search .'%');
        })
            ->orderBy('blog_id','desc')
            ->select('blog.*',
                DB::raw('DATE_FORMAT(blog.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('is_show',$request->active);
        else $row->where('is_show','1');

        $row->where('blog.parent_id',$request->parent_id);
        
        $row = $row->paginate(20);

        return  view('admin.blog.blog',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Blog();
        $row->blog_image = '/media/default.jpg';
        $row->blog_date = date("d.m.Y H:i");
        return  view('admin.blog.blog-edit', [
            'title' => 'Добавить новость',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blog_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.blog.blog-edit', [
                'title' => 'Добавить новость',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $blog = new Blog();
        $blog->blog_name_ru = $request->blog_name_ru;
        $blog->blog_name_kz = $request->blog_name_kz;
        $blog->blog_name_en = $request->blog_name_en;
        $blog->blog_text_ru = $request->blog_text_ru;
        $blog->blog_text_kz = $request->blog_text_kz;
        $blog->blog_text_en = $request->blog_text_en;
        $blog->blog_desc_ru = $request->blog_desc_ru;
        $blog->blog_desc_kz = $request->blog_desc_kz;
        $blog->blog_desc_en = $request->blog_desc_en;
        $blog->blog_image = $request->blog_image;
        $blog->blog_redirect = $request->blog_redirect;

        $url = '';
        if($request->parent_id == '') $request->parent_id = null;
        else {
            $level = Blog::where('blog_id',$request->parent_id)->first();
            $level = $level->parent_level + 1;
            $blog->parent_level = $level;
            $url = '?parent_id=' .$request->parent_id;
        }
        $blog->parent_id = $request->parent_id;
        $timestamp = strtotime($request->blog_date);
        $blog->blog_date = date("Y-m-d H:i", $timestamp);
        $blog->save();
        
        return redirect('/admin/blog'.$url);
    }

    public function edit($id)
    {
        $row = Blog::select('blog.*',
                DB::raw('DATE_FORMAT(blog.blog_date,"%d.%m.%Y %H:%i") as blog_date'))
                ->where('blog.blog_id',$id)
                ->first();
     
        return  view('admin.blog.blog-edit', [
            'title' => 'Изменить новость',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'blog_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.blog.blog-edit', [
                'title' => 'Изменить новость',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $blog = Blog::find($id);
        $blog->blog_name_ru = $request->blog_name_ru;
        $blog->blog_name_kz = $request->blog_name_kz;
        $blog->blog_name_en = $request->blog_name_en;
        $blog->blog_text_ru = $request->blog_text_ru;
        $blog->blog_text_kz = $request->blog_text_kz;
        $blog->blog_text_en = $request->blog_text_en;
        $blog->blog_desc_ru = $request->blog_desc_ru;
        $blog->blog_desc_kz = $request->blog_desc_kz;
        $blog->blog_desc_en = $request->blog_desc_en;
        $blog->blog_image = $request->blog_image;
        $blog->blog_redirect = $request->blog_redirect;
        $timestamp = strtotime($request->blog_date);
        $blog->blog_date = date("Y-m-d H:i", $timestamp);
        $blog->save();
        
        if($request->parent_id == '') $url = '';
        else $url = '?parent_id=' .$request->parent_id;
        
        return redirect('/admin/blog'.$url);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
    }

    public function changeIsShow(Request $request){
        $blog = Blog::find($request->id);
        $blog->is_show = $request->is_show;
        $blog->save();
    }
}
