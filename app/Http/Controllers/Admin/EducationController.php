<?php

namespace App\Http\Controllers\Admin;

use App\Models\Education;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminWebsite');
    }

    public function index(Request $request)
    {
        $row = Education::where(function($query) use ($request){
            $query->where('education_name_kz','like','%' .$request->search .'%')
                ->orWhere('education_name_ru','like','%' .$request->search .'%')
                ->orWhere('education_name_en','like','%' .$request->search .'%');
        })
            ->orderBy('education_id','desc')
            ->select('education.*',
                DB::raw('DATE_FORMAT(education.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('is_show',$request->active);
        else $row->where('is_show','1');

        $row->where('education.parent_id',$request->parent_id);
        
        $row = $row->paginate(20);

        return  view('admin.education.education',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Education();
        $row->education_image = '/media/default.jpg';
        
        return  view('admin.education.education-edit', [
            'title' => 'Добавить страницу',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'education_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.education.education-edit', [
                'title' => 'Добавить страницу',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $education = new Education();
        $education->education_name_ru = $request->education_name_ru;
        $education->education_name_kz = $request->education_name_kz;
        $education->education_name_en = $request->education_name_en;
        $education->education_text_ru = $request->education_text_ru;
        $education->education_text_kz = $request->education_text_kz;
        $education->education_text_en = $request->education_text_en;
        $education->education_desc_ru = $request->education_desc_ru;
        $education->education_desc_kz = $request->education_desc_kz;
        $education->education_desc_en = $request->education_desc_en;
        $education->education_image = $request->education_image;
        $education->education_redirect = $request->education_redirect;

        $url = '';
        if($request->parent_id == '') $request->parent_id = null;
        else {
            $level = Education::where('education_id',$request->parent_id)->first();
            $level = $level->parent_level + 1;
            $education->parent_level = $level;
            $url = '?parent_id=' .$request->parent_id;
        }
        $education->parent_id = $request->parent_id;
        $education->save();
        
        return redirect('/admin/education'.$url);
    }

    public function edit($id)
    {
        $row = Education::select('education.*',
                DB::raw('DATE_FORMAT(education.education_date,"%d.%m.%Y %H:%i") as education_date'))
            ->where('education.education_id',$id)
            ->first();
     
        return  view('admin.education.education-edit', [
            'title' => 'Изменить страницу',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'education_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.education.education-edit', [
                'title' => 'Изменить страницу',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $education = Education::find($id);
        $education->education_name_ru = $request->education_name_ru;
        $education->education_name_kz = $request->education_name_kz;
        $education->education_name_en = $request->education_name_en;
        $education->education_text_ru = $request->education_text_ru;
        $education->education_text_kz = $request->education_text_kz;
        $education->education_text_en = $request->education_text_en;
        $education->education_desc_ru = $request->education_desc_ru;
        $education->education_desc_kz = $request->education_desc_kz;
        $education->education_desc_en = $request->education_desc_en;
        $education->education_image = $request->education_image;
        $education->education_redirect = $request->education_redirect;
        $education->save();
        
        if($request->parent_id == '') $url = '';
        else $url = '?parent_id=' .$request->parent_id;
        
        return redirect('/admin/education'.$url);
    }

    public function destroy($id)
    {
        $education = Education::find($id);
        $education->delete();
    }

    public function changeIsShow(Request $request){
        $education = Education::find($request->id);
        $education->is_show = $request->is_show;
        $education->save();
    }
}
