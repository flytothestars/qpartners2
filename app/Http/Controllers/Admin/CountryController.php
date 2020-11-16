<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminWebsite');
    }

    public function index(Request $request)
    {
        $row = Country::where(function($query) use ($request){
            $query->where('country_name_kz','like','%' .$request->search .'%')
                ->orWhere('country_name_ru','like','%' .$request->search .'%')
                ->orWhere('country_name_ru','like','%' .$request->search .'%');
            })
            ->orderBy('country_id','desc')
            ->select('*',
                DB::raw('DATE_FORMAT(country.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('country.is_show',$request->active);
        else $row->where('country.is_show','1');

        $row = $row->paginate(20);

        return  view('admin.country.country',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Country();
        $row->country_image = '/media/default.jpg';

        return  view('admin.country.country-edit', [
            'title' => 'Добавить страну',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.country.country-edit', [
                'title' => 'Добавить страну',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $country = new Country();
        $country->country_name_ru = $request->country_name_ru;
        $country->country_name_kz = $request->country_name_kz;
        $country->country_name_en = $request->country_name_en;
        $country->country_text_ru = $request->country_text_ru;
        $country->country_text_kz = $request->country_text_kz;
        $country->country_text_en = $request->country_text_en;
        $country->country_desc_ru = $request->country_desc_ru;
        $country->country_desc_kz = $request->country_desc_kz;
        $country->country_desc_en = $request->country_desc_en;
        $country->country_image = $request->country_image;
        $country->sort_num = is_numeric($request->sort_num)?$request->sort_num:1000;
        $country->country_redirect = $request->country_redirect;
        $country->save();
        
        return redirect('/admin/country');
    }

    public function edit($id)
    {
        $row = Country::find($id);
     
        return  view('admin.country.country-edit', [
            'title' => 'Изменить страну',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'country_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.country.country-edit', [
                'title' => 'Изменить страну',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $country = Country::find($id);
        $country->country_name_ru = $request->country_name_ru;
        $country->country_name_kz = $request->country_name_kz;
        $country->country_name_en = $request->country_name_en;
        $country->country_text_ru = $request->country_text_ru;
        $country->country_text_kz = $request->country_text_kz;
        $country->country_text_en = $request->country_text_en;
        $country->country_desc_ru = $request->country_desc_ru;
        $country->country_desc_kz = $request->country_desc_kz;
        $country->country_desc_en = $request->country_desc_en;
        $country->country_image = $request->country_image;
        $country->sort_num = is_numeric($request->sort_num)?$request->sort_num:1000;
        $country->country_redirect = $request->country_redirect;
        $country->save();

        return redirect('/admin/country');
    }

    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();
    }

    public function changeIsShow(Request $request){
        $country = Country::find($request->id);
        $country->is_show = $request->is_show;
        $country->save();
    }
}
