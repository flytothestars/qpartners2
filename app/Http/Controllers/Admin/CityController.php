<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminWebsite');

        $country_row = Country::orderBy('sort_num','asc')->orderBy('country_name_ru','asc')->get();
        View::share('country_row', $country_row);
    }

    public function index(Request $request)
    {
        $row = City::leftJoin('country','country.country_id','=','city.country_id')
            ->where(function($query) use ($request){
            $query->where('city_name_kz','like','%' .$request->search .'%')
                ->orWhere('city_name_ru','like','%' .$request->search .'%')
                ->orWhere('country_name_ru','like','%' .$request->search .'%');
            })
            ->orderBy('city_id','desc')
            ->select('*',
                DB::raw('DATE_FORMAT(city.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('city.is_show',$request->active);
        else $row->where('city.is_show','1');

        $row = $row->paginate(20);

        return  view('admin.city.city',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new City();
        $row->city_image = '/media/default.jpg';

        return  view('admin.city.city-edit', [
            'title' => 'Добавить город',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.city.city-edit', [
                'title' => 'Добавить город',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $city = new City();
        $city->city_name_ru = $request->city_name_ru;
        $city->city_name_kz = $request->city_name_kz;
        $city->city_name_en = $request->city_name_en;
        $city->city_text_ru = $request->city_text_ru;
        $city->city_text_kz = $request->city_text_kz;
        $city->city_text_en = $request->city_text_en;
        $city->city_desc_ru = $request->city_desc_ru;
        $city->city_desc_kz = $request->city_desc_kz;
        $city->city_desc_en = $request->city_desc_en;
        $city->city_image = $request->city_image;
        $city->country_id = $request->country_id;
        $city->sort_num = is_numeric($request->sort_num)?$request->sort_num:1000;
        $city->city_redirect = $request->city_redirect;

        $url = '';
        if($request->parent_id == '') $request->parent_id = null;
        else {
            $level = City::where('city_id',$request->parent_id)->first();
            $level = $level->parent_level + 1;
            $city->parent_level = $level;
            $url = '?parent_id=' .$request->parent_id;
        }
        $city->parent_id = $request->parent_id;
        $city->save();
        
        return redirect('/admin/city'.$url);
    }

    public function edit($id)
    {
        $row = City::find($id);
     
        return  view('admin.city.city-edit', [
            'title' => 'Изменить город',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'city_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.city.city-edit', [
                'title' => 'Изменить город',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $city = City::find($id);
        $city->city_name_ru = $request->city_name_ru;
        $city->city_name_kz = $request->city_name_kz;
        $city->city_name_en = $request->city_name_en;
        $city->city_text_ru = $request->city_text_ru;
        $city->city_text_kz = $request->city_text_kz;
        $city->city_text_en = $request->city_text_en;
        $city->city_desc_ru = $request->city_desc_ru;
        $city->city_desc_kz = $request->city_desc_kz;
        $city->city_desc_en = $request->city_desc_en;
        $city->city_image = $request->city_image;
        $city->country_id = $request->country_id;
        $city->sort_num = is_numeric($request->sort_num)?$request->sort_num:1000;
        $city->city_redirect = $request->city_redirect;
        $city->save();
        
        if($request->parent_id == '') $url = '';
        else $url = '?parent_id=' .$request->parent_id;
        
        return redirect('/admin/city'.$url);
    }

    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
    }

    public function changeIsShow(Request $request){
        $city = City::find($request->id);
        $city->is_show = $request->is_show;
        $city->save();
    }
}
