<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminWebsite');
    }

    public function index(Request $request)
    {
        $row = Project::where(function($query) use ($request){
            $query->where('project_name_kz','like','%' .$request->search .'%')
                ->orWhere('project_name_ru','like','%' .$request->search .'%')
                ->orWhere('project_name_en','like','%' .$request->search .'%');
        })
            ->orderBy('project_id','desc')
            ->select('project.*',
                DB::raw('DATE_FORMAT(project.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('is_show',$request->active);
        else $row->where('is_show','1');
        
        $row = $row->paginate(20);

        return  view('admin.project.project',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Project();
        $row->project_image = '/media/default.jpg';
   
        return  view('admin.project.project-edit', [
            'title' => 'Добавить проект',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.project.project-edit', [
                'title' => 'Добавить проект',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $project = new Project();
        $project->project_name_ru = $request->project_name_ru;
        $project->project_name_kz = $request->project_name_kz;
        $project->project_name_en = $request->project_name_en;
        $project->project_text_en = $request->project_text_en;
        $project->project_text_kz = $request->project_text_kz;
        $project->project_text_ru = $request->project_text_ru;
        $project->project_image = $request->project_image;
        $project->project_redirect = $request->project_redirect;
        $project->sort_num = ($request->sort_num=='')?1000:$request->sort_num;
        $project->save();
        
        return redirect('/admin/project');
    }

    public function edit($id)
    {
        $row = Project::select('project.*')
            ->where('project.project_id',$id)
            ->first();
     
        return  view('admin.project.project-edit', [
            'title' => 'Изменить проект',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'project_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.project.project-edit', [
                'title' => 'Изменить проект',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $project = Project::find($id);
        $project->project_name_ru = $request->project_name_ru;
        $project->project_name_kz = $request->project_name_kz;
        $project->project_name_en = $request->project_name_en;
        $project->project_text_en = $request->project_text_en;
        $project->project_text_kz = $request->project_text_kz;
        $project->project_text_ru = $request->project_text_ru;
        $project->project_image = $request->project_image;
        $project->project_redirect = $request->project_redirect;
        $project->sort_num = ($request->sort_num=='')?1000:$request->sort_num;
        $project->save();
        
        return redirect('/admin/project');
    }

    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
    }

    public function changeIsShow(Request $request){
        $project = Project::find($request->id);
        $project->is_show = $request->is_show;
        $project->save();
    }
}
