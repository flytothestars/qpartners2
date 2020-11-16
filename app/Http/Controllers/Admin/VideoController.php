<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminWebsite');
    }

    public function index(Request $request)
    {
        $row = Video::where(function($query) use ($request){
            $query->where('video_name_kz','like','%' .$request->search .'%')
                ->orWhere('video_name_ru','like','%' .$request->search .'%')
                ->orWhere('video_name_en','like','%' .$request->search .'%');
        })
            ->orderBy('video_id','desc')
            ->select('video.*',
                DB::raw('DATE_FORMAT(video.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('is_show',$request->active);
        else $row->where('is_show','1');

        $row->where('video.parent_id',$request->parent_id);

        $row = $row->paginate(20);

        return  view('admin.video.video',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Video();
        $row->video_image = '/media/default.jpg';

        return  view('admin.video.video-edit', [
            'title' => 'Добавить видео',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'video_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.video.video-edit', [
                'title' => 'Добавить видео',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $video = new Video();
        $video->video_name_ru = $request->video_name_ru;
        $video->video_name_kz = $request->video_name_kz;
        $video->video_name_en = $request->video_name_en;
        $video->video_image = $request->video_image;

        $video_url = str_replace("watch?v=","embed/",$request->video_text_ru);
        $video->video_text_ru  = $video_url;

        $video_url = str_replace("watch?v=","embed/",$request->video_text_kz);
        $video->video_text_kz  = $video_url;

        $video_url = str_replace("watch?v=","embed/",$request->video_text_en);
        $video->video_text_en  = $video_url;

        $video->save();

        return redirect('/admin/video');
    }

    public function edit($id)
    {
        $row = Video::select('video.*')
            ->where('video.video_id',$id)
            ->first();

        return  view('admin.video.video-edit', [
            'title' => 'Изменить видео',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'video_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.video.video-edit', [
                'title' => 'Изменить видео',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $video = Video::find($id);
        $video->video_name_ru = $request->video_name_ru;
        $video->video_name_kz = $request->video_name_kz;
        $video->video_name_en = $request->video_name_en;

        $video_url = str_replace("watch?v=","embed/",$request->video_text_ru);
        $video->video_text_ru  = $video_url;

        $video_url = str_replace("watch?v=","embed/",$request->video_text_kz);
        $video->video_text_kz  = $video_url;

        $video_url = str_replace("watch?v=","embed/",$request->video_text_en);
        $video->video_text_en  = $video_url;

        $video->save();

        return redirect('/admin/video');
    }

    public function destroy($id)
    {
        $video = Video::find($id);
        $video->delete();
    }

    public function changeIsShow(Request $request){
        $video = Video::find($request->id);
        $video->is_show = $request->is_show;
        $video->save();
    }
}
