<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminWebsite');
    }

    public function index(Request $request)
    {
        $row = Slider::where(function($query) use ($request){
            $query->where('slider_name_kz','like','%' .$request->search .'%')
                ->orWhere('slider_name_ru','like','%' .$request->search .'%')
                ->orWhere('slider_name_en','like','%' .$request->search .'%');
        })
            ->orderBy('slider_id','desc')
            ->select('slider.*',
                DB::raw('DATE_FORMAT(slider.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('is_show',$request->active);
        else $row->where('is_show','1');

        $row->where('slider.parent_id',$request->parent_id);
        
        $row = $row->paginate(20);

        return  view('admin.slider.slider',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Slider();
        $row->slider_image = '/media/default.jpg';

        return  view('admin.slider.slider-edit', [
            'title' => 'Добавить фото',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slider_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.slider.slider-edit', [
                'title' => 'Добавить фото',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $slider = new Slider();
        $slider->slider_name_ru = $request->slider_name_ru;
        $slider->slider_name_kz = $request->slider_name_kz;
        $slider->slider_name_en = $request->slider_name_en;
        $slider->slider_text_ru = $request->slider_text_ru;
        $slider->slider_text_kz = $request->slider_text_kz;
        $slider->slider_text_en = $request->slider_text_en;
        $slider->slider_desc_ru = $request->slider_desc_ru;
        $slider->slider_desc_kz = $request->slider_desc_kz;
        $slider->slider_desc_en = $request->slider_desc_en;
        $slider->slider_image = $request->slider_image;
        $slider->sort_num = is_numeric($request->sort_num)?$request->sort_num:1000;
        $slider->slider_redirect = $request->slider_redirect;

        $url = '';
        if($request->parent_id == '') $request->parent_id = null;
        else {
            $level = Slider::where('slider_id',$request->parent_id)->first();
            $level = $level->parent_level + 1;
            $slider->parent_level = $level;
            $url = '?parent_id=' .$request->parent_id;
        }
        $slider->parent_id = $request->parent_id;
        $slider->save();
        
        return redirect('/admin/slider'.$url);
    }

    public function edit($id)
    {
        $row = Slider::find($id);
     
        return  view('admin.slider.slider-edit', [
            'title' => 'Изменить фото',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'slider_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.slider.slider-edit', [
                'title' => 'Изменить фото',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $slider = Slider::find($id);
        $slider->slider_name_ru = $request->slider_name_ru;
        $slider->slider_name_kz = $request->slider_name_kz;
        $slider->slider_name_en = $request->slider_name_en;
        $slider->slider_text_ru = $request->slider_text_ru;
        $slider->slider_text_kz = $request->slider_text_kz;
        $slider->slider_text_en = $request->slider_text_en;
        $slider->slider_desc_ru = $request->slider_desc_ru;
        $slider->slider_desc_kz = $request->slider_desc_kz;
        $slider->slider_desc_en = $request->slider_desc_en;
        $slider->slider_image = $request->slider_image;
        $slider->sort_num = is_numeric($request->sort_num)?$request->sort_num:1000;
        $slider->slider_redirect = $request->slider_redirect;
        $slider->save();
        
        if($request->parent_id == '') $url = '';
        else $url = '?parent_id=' .$request->parent_id;
        
        return redirect('/admin/slider'.$url);
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
    }

    public function changeIsShow(Request $request){
        $slider = Slider::find($request->id);
        $slider->is_show = $request->is_show;
        $slider->save();
    }
}
