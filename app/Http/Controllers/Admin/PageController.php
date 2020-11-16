<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminWebsite');
    }

    public function index(Request $request)
    {
        $row = Page::where(function($query) use ($request){
            $query->where('page_name_kz','like','%' .$request->search .'%')
                ->orWhere('page_name_ru','like','%' .$request->search .'%')
                ->orWhere('page_name_en','like','%' .$request->search .'%');
        })
            ->orderBy('page_id','desc')
            ->select('page.*',
                DB::raw('DATE_FORMAT(page.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('is_show',$request->active);
        else $row->where('is_show','1');

     /*   $row->where('page.parent_id',$request->parent_id);*/
        
        $row = $row->paginate(20);

        return  view('admin.page.page',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Page();
        
        return  view('admin.page.page-edit', [
            'title' => 'Добавить страницу',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.page.page-edit', [
                'title' => 'Добавить страницу',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $page = new Page();
        $page->page_name_ru = $request->page_name_ru;
        $page->page_name_kz = $request->page_name_kz;
        $page->page_name_en = $request->page_name_en;
        $page->page_text_kz = $request->page_text_kz;
        $page->page_text_ru = $request->page_text_ru;
        $page->page_text_en = $request->page_text_en;

        $url = '';
        $page->save();
        
        return redirect('/admin/page'.$url);
    }

    public function edit($id)
    {
        $row = Page::find($id);
     
        return  view('admin.page.page-edit', [
            'title' => 'Изменить страницу',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'page_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.page.page-edit', [
                'title' => 'Изменить страницу',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $page = Page::find($id);
        $page->page_name_ru = $request->page_name_ru;
        $page->page_name_kz = $request->page_name_kz;
        $page->page_name_en = $request->page_name_en;
        $page->page_text_kz = $request->page_text_kz;
        $page->page_text_ru = $request->page_text_ru;
        $page->page_text_en = $request->page_text_en;
        $page->save();
        
        if($request->parent_id == '') $url = '';
        else $url = '?parent_id=' .$request->parent_id;
        
        return redirect('/admin/page'.$url);
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
    }

    public function changeIsShow(Request $request){
        $page = Page::find($request->id);
        $page->is_show = $request->is_show;
        $page->save();
    }
}
