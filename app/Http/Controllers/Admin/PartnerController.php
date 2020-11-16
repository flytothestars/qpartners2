<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $row = Partner::where(function($query) use ($request){
            $query->where('partner_name_kz','like','%' .$request->search .'%')
                ->orWhere('partner_name_ru','like','%' .$request->search .'%')
                ->orWhere('partner_name_en','like','%' .$request->search .'%');
        })
            ->orderBy('partner_id','desc')
            ->select('partner.*',
                DB::raw('DATE_FORMAT(partner.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('is_show',$request->active);
        else $row->where('is_show','1');

        $row->where('partner.parent_id',$request->parent_id);
        
        $row = $row->paginate(20);

        return  view('admin.partner.partner',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Partner();
        $row->partner_image = '/media/default.jpg';

        return  view('admin.partner.partner-edit', [
            'title' => 'Добавить партнера',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'partner_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.partner.partner-edit', [
                'title' => 'Добавить партнера',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $partner = new Partner();
        $partner->partner_name_ru = $request->partner_name_ru;
        $partner->partner_name_kz = $request->partner_name_kz;
        $partner->partner_name_en = $request->partner_name_en;
        $partner->partner_text_ru = $request->partner_text_ru;
        $partner->partner_text_kz = $request->partner_text_kz;
        $partner->partner_text_en = $request->partner_text_en;
        $partner->partner_desc_ru = $request->partner_desc_ru;
        $partner->partner_desc_kz = $request->partner_desc_kz;
        $partner->partner_desc_en = $request->partner_desc_en;
        $partner->partner_image = $request->partner_image;
        $partner->sort_num = is_numeric($request->sort_num)?$request->sort_num:1000;
        $partner->partner_redirect = $request->partner_redirect;

        $url = '';
        if($request->parent_id == '') $request->parent_id = null;
        else {
            $level = Partner::where('partner_id',$request->parent_id)->first();
            $level = $level->parent_level + 1;
            $partner->parent_level = $level;
            $url = '?parent_id=' .$request->parent_id;
        }
        $partner->parent_id = $request->parent_id;
        $partner->save();
        
        return redirect('/admin/partner'.$url);
    }

    public function edit($id)
    {
        $row = Partner::find($id);
     
        return  view('admin.partner.partner-edit', [
            'title' => 'Изменить партнера',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'partner_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.partner.partner-edit', [
                'title' => 'Изменить партнера',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $partner = Partner::find($id);
        $partner->partner_name_ru = $request->partner_name_ru;
        $partner->partner_name_kz = $request->partner_name_kz;
        $partner->partner_name_en = $request->partner_name_en;
        $partner->partner_text_ru = $request->partner_text_ru;
        $partner->partner_text_kz = $request->partner_text_kz;
        $partner->partner_text_en = $request->partner_text_en;
        $partner->partner_desc_ru = $request->partner_desc_ru;
        $partner->partner_desc_kz = $request->partner_desc_kz;
        $partner->partner_desc_en = $request->partner_desc_en;
        $partner->partner_image = $request->partner_image;
        $partner->sort_num = is_numeric($request->sort_num)?$request->sort_num:1000;
        $partner->partner_redirect = $request->partner_redirect;
        $partner->save();
        
        if($request->parent_id == '') $url = '';
        else $url = '?parent_id=' .$request->parent_id;
        
        return redirect('/admin/partner'.$url);
    }

    public function destroy($id)
    {
        $partner = Partner::find($id);
        $partner->delete();
    }

    public function changeIsShow(Request $request){
        $partner = Partner::find($request->id);
        $partner->is_show = $request->is_show;
        $partner->save();
    }
}
