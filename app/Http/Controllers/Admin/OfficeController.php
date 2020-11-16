<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\Fond;
use App\Models\UserOperation;
use App\Models\UserPacket;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class OfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        
        $users = Users::orderBy('user_id','asc')->where('status_id','>',3)->where('is_director_office',0)->where('status_id','!=',11)->get();
        View::share('users_row', $users);
    }

    public function index(Request $request)
    {
        $request->row = Users::leftJoin('city','city.city_id','=','users.city_id')
                            ->leftJoin('country','country.country_id','=','city.country_id')
                            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
                            ->orderBy('users.user_id','desc')
                            ->where('users.is_director_office',1)
                            ->select('users.*','city.*','country.*',
                                DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y") as date'),
                                'recommend.name as recommend_name',
                                'recommend.user_id as recommend_id',
                                'recommend.login as recommend_login',
                                'recommend.last_name as recommend_last_name',
                                'recommend.middle_name as recommend_middle_name',
                                'recommend.user_id as recommend_user_id'
                            );

        if(isset($request->user_name) && $request->user_name != '')
            $request->row->where(function($query) use ($request){
                $query->where('users.name','like','%' .$request->user_name .'%')
                    ->orWhere('users.last_name','like','%' .$request->user_name .'%')
                    ->orWhere('users.login','like','%' .$request->user_name .'%')
                    ->orWhere('users.email','like','%' .$request->user_name .'%')
                    ->orWhere('users.middle_name','like','%' .$request->user_name .'%');
            });

        if(isset($request->sponsor_name) && $request->sponsor_name != '')
            $request->row->where(function($query) use ($request){
                $query->where('recommend.name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.last_name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.login','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.email','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.middle_name','like','%' .$request->sponsor_name .'%');
            });

        if(isset($request->city_name) && $request->city_name != '')
            $request->row->where(function($query) use ($request){
                $query->where('city.city_name_ru','like','%' .$request->city_name .'%')
                    ->orWhere('country.country_name_ru','like','%' .$request->city_name .'%');
            });
        
        
        $request->row = $request->row->paginate(10);
        
        return  view('admin.office.office',[
            'row' => $request,
            'title' => 'Офис',
            'request' => $request
        ]);
    }

    public function showAddUserOffice(Request $request,$user_id = null)
    {
        if($user_id > 0)
             $row = Users::find($user_id);
        else $row = new Users();

        return  view('admin.office.office-add', [
            'title' => 'Офис',
            'row' => $row,
            'user_id' => $user_id
        ]);
    }

    public function addUserOffice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.office.office-add', [
                'title' => 'Офис',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $user = Users::where('user_id',$request->user_id)->first();
        $is_office_director = $user->is_director_office;

        $user->is_director_office = 1;
        $user->office_name = $request->office_name;
        $user->office_limit = is_numeric($request->office_limit)?$request->office_limit:0;

        if($request->edit_user_id == null){
            $user->office_register_date = date("Y-m-d H:i:s");
        }

        $user->save();

        if($is_office_director == 0){
            $operation = new UserOperation();
            $operation->author_id = null;
            $operation->recipient_id = $request->user_id;
            $operation->money = null;
            $operation->operation_id = 1;
            $operation->operation_type_id = 10;
            $operation->operation_comment = 'Поздравляю! Вы стали директорам офиса "' .$request->office_name .'"';
            $operation->save();
        }

        return redirect('/admin/office');
    }

    public function deleteUserOffice($id){
        $user = Users::find($id);
        $user->is_director_office = 0;
        $user->save();
    }

    public function robotClearAfterMonthProfit()
    {
        $users = Users::where('is_director_office',1)->get();
        foreach ($users as $key => $item){
            $user = Users::where('user_id',$item->user_id)->first();
            $diff = abs(strtotime(date("Y-m-d",strtotime($user->office_register_date))) - strtotime(date("Y-m-d")));
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if($months > 0){
                $user->office_register_date = date("Y-m-d");
                $user->office_month_profit = 0;
                $user->save();
            }
        }
        echo 'Успешно выполнено';
    }
}
