<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\UserInfo;
use App\Models\UserOperation;
use App\Models\UserPacket;
use App\Models\Users;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile');
        $this->middleware('admin', ['only' => ['profile']]);
    }

    public function profile($id)
    {
        $row = Users::leftJoin('city','city.city_id','=','users.city_id')
            ->leftJoin('country','country.country_id','=','city.country_id')
            ->leftJoin('user_status','user_status.user_status_id','=','users.status_id')
            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
            ->leftJoin('user_info','user_info.user_id','=','users.user_id')
            ->leftJoin('city as fact_city','fact_city.city_id','=','user_info.fact_city_id')
            ->leftJoin('country as fact_country','fact_country.country_id','=','fact_city.country_id')
            ->where('users.user_id',$id)
            ->select('users.*',
                'city.*',
                'country.*',
                'fact_city.city_name_ru as fact_city_name_ru',
                'fact_country.country_name_ru as fact_country_name_ru',
                'user_status.*',
                'user_info.*',
                'users.user_id',
                'users.instagram',
                'recommend.name as recommend_name',
                'recommend.last_name as recommend_last_name',
                'recommend.user_id as recommend_user_id',
                DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y") as date'))
            ->first();

        if($row == null) abort(404);

        $row->packet = UserPacket::leftJoin('users','users.user_id','=','user_packet.user_id')
            ->leftJoin('packet','packet.packet_id','=','user_packet.packet_id')
            ->where('user_packet.user_id',$id)
            ->orderBy('packet.sort_num')
            ->get();

        $row->profit_all = UserOperation::where('recipient_id',$id)
            ->where('operation_type_id','!=',2)
            ->where('operation_id',1)
            ->sum('money');

        $row->profit_today = UserOperation::where('recipient_id',$id)
            ->where('operation_type_id','!=',2)
            ->where('operation_id',1)
            ->where('created_at','>',date("Y-m-d"))
            ->sum('money');

        $row->profit_last_week = UserOperation::where('recipient_id',$id)
            ->where('operation_type_id','!=',2)
            ->where('operation_id',1)
            ->where('created_at','>',date("Y-m-d",strtotime("-7 day")))
            ->sum('money');

        $row->profit_last_month = UserOperation::where('recipient_id',$id)
            ->where('operation_type_id','!=',2)
            ->where('operation_id',1)
            ->where('created_at','>',date("Y-m-d",strtotime("-30 day")))
            ->sum('money');

        $row->shareholder_profit_today = UserOperation::where('operation_type_id',5)
            ->where('created_at','>',date("Y-m-d"))
            ->sum('money');

        $row->shareholder_count = Users::where('users.user_share','>',0)->count();

        $row->user_share_sum = Users::where('users.user_share','>',0)->sum('users.user_share');
        
        if($row->shareholder_profit_today  != 0 && $row->user_share_sum != 0)
            $row->shareholder_average_mount = round($row->shareholder_profit_today / $row->user_share_sum,2);
        else $row->shareholder_average_mount = 0;

        $row->currency = Currency::where('currency_name','тенге')->first();

        $row->password_new = 123456;

        $row->statuses = UserStatus::orderBy('sort_num','asc')
            ->where('is_show',1)
            ->get();

        return  view('admin.profile.profile', [
            'row' => $row
        ]);
    }

    public function myProfile()
    {
        $row = Users::leftJoin('city','city.city_id','=','users.city_id')
            ->leftJoin('country','country.country_id','=','city.country_id')
            ->leftJoin('user_status','user_status.user_status_id','=','users.status_id')
            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
            ->leftJoin('user_info','user_info.user_id','=','users.user_id')
            ->leftJoin('city as fact_city','fact_city.city_id','=','user_info.fact_city_id')
            ->leftJoin('country as fact_country','fact_country.country_id','=','fact_city.country_id')
            ->where('users.user_id',Auth::user()->user_id)
            ->select('users.*',
                'city.*',
                'country.*',
                'fact_city.city_name_ru as fact_city_name_ru',
                'fact_country.country_name_ru as fact_country_name_ru',
                'user_info.*',
                'user_status.*',
                'recommend.name as recommend_name',
                'recommend.last_name as recommend_last_name',
                'recommend.user_id as recommend_user_id',
                DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y") as date'))
            ->first();
        
        if($row == null) abort(404);

        $row->packet = UserPacket::leftJoin('users','users.user_id','=','user_packet.user_id')
                        ->leftJoin('packet','packet.packet_id','=','user_packet.packet_id')
                        ->where('user_packet.user_id',Auth::user()->user_id)
                        ->orderBy('packet.sort_num')
                        ->get();

        $row->profit_all = UserOperation::where('recipient_id',Auth::user()->user_id)
            ->where('operation_type_id','!=',2)
            ->where('operation_id',1)
            ->sum('money');

        $row->profit_today = UserOperation::where('recipient_id',Auth::user()->user_id)
            ->where('operation_type_id','!=',2)
            ->where('operation_id',1)
            ->where('created_at','>',date("Y-m-d"))
            ->sum('money');

        $row->profit_last_week = UserOperation::where('recipient_id',Auth::user()->user_id)
            ->where('operation_type_id','!=',2)
            ->where('operation_id',1)
            ->where('created_at','>',date("Y-m-d",strtotime("-7 day")))
            ->sum('money');

        $row->profit_last_month = UserOperation::where('recipient_id',Auth::user()->user_id)
            ->where('operation_type_id','!=',2)
            ->where('operation_id',1)
            ->where('created_at','>',date("Y-m-d",strtotime("-30 day")))
            ->sum('money');

        $row->shareholder_profit_today = UserOperation::where('operation_type_id',5)
            ->where('operation_type_id','!=',2)
            ->where('created_at','>',date("Y-m-d"))
            ->sum('money');

        $row->shareholder_count = Users::where('users.user_share','>',0)->count();

        $row->user_share_sum = Users::where('users.user_share','>',0)->sum('users.user_share');

        if($row->shareholder_profit_today  != 0 && $row->user_share_sum != 0)
            $row->shareholder_average_mount = round($row->shareholder_profit_today / $row->user_share_sum,2);
        else $row->shareholder_average_mount = 0;

        $row->currency = Currency::where('currency_name','тенге')->first();

        $row->password_new = 123456;

        $row->statuses = UserStatus::orderBy('sort_num','asc')
            ->where('is_show',1)
            ->get();

        return  view('admin.profile.profile', [
            'row' => $row,
            'is_own' => 1
        ]);
    }

    public function edit()
    {
        $row = Users::leftJoin('user_info','user_info.user_id','=','users.user_id')
            ->where('users.user_id',Auth::user()->user_id)
            ->first();

        $country_row = Country::orderBy('sort_num','asc')
            ->orderBy('country_name_ru','asc')
            ->where('is_show',1)
            ->get();

        $city_row = City::orderBy('city_name_ru','asc')
            ->where('is_show',1)
            ->where('country_id',1)
            ->get();

        $statuses = UserStatus::orderBy('sort_num','asc')
            ->where('is_show',1)
            ->get();

        return  view('admin.profile.profile-edit', [
            'title' => 'Редактировать данные',
            'country_row' => $country_row,
            'statuses' => $statuses,
            'row' => $row,
            'city_row' => $city_row
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'iin' => 'required',
            'iban' => 'required',
            'card_number' => 'required',
            'bank_name' => 'required',
            'document_number' => 'required',
            'email' => 'required|email|unique:users,email,' .Auth::user()->user_id .',user_id,deleted_at,NULL',
            'login' => 'required|unique:users,login,' .Auth::user()->user_id .',user_id,deleted_at,NULL',
            'phone' => 'required|unique:users,phone,' .Auth::user()->user_id .',user_id,deleted_at,NULL'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();

            $country_row = Country::orderBy('sort_num','asc')
                ->orderBy('country_name_ru','asc')
                ->where('is_show',1)
                ->get();

            $city_row = City::orderBy('city_name_ru','asc')
                ->where('is_show',1)
                ->where('country_id',1)
                ->get();

            $statuses = UserStatus::orderBy('sort_num','asc')
                ->where('is_show',1)
                ->get();

            return  view('admin.profile.profile-edit', [
                'title' => 'Редактировать данные',
                'row' => (object) $request->all(),
                'error' => $error[0],
                'country_row' => $country_row,
                'statuses' => $statuses,
                'city_row' => $city_row
            ]);
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->middle_name = $request->middle_name;

        if(Auth::user()->role_id == 1){
            $user->status_id = $request->status_id?$request->status_id:null;
        }

        $request->instagram = str_replace('http://www.instagram.com/','',$request->instagram);
        $request->instagram = str_replace('https://www.instagram.com/','',$request->instagram);
        $request->instagram = str_replace('https://instagram.com/','',$request->instagram);
        $request->instagram = str_replace('http://instagram.com/','',$request->instagram);

        $user->instagram = $request->instagram;
        $user->email = $request->email;
        $user->login = $request->login;
        $user->phone = $request->phone;
        $user->avatar = $request->avatar;
        $user->city_id = $request->city_id;
        $user->save();

        $user_info = UserInfo::where('user_id',$user->user_id)->first();
        if($user_info == null) $user_info = new UserInfo();
        $user_info->user_id = $user->user_id;
        $user_info->iin = $request->iin;
        $user_info->fact_city_id = $request->fact_city_id;
        $user_info->address = $request->address;
        $user_info->iban = $request->iban;
        $user_info->fact_address = $request->fact_address;
        $user_info->card_number = $request->card_number;
        $user_info->bank_name = $request->bank_name;
        $user_info->document_number = $request->document_number;
        $user_info->is_male = $request->is_male;
        $user_info->size_ring = $request->size_ring;
        $user_info->is_insurance = $request->is_insurance;
        $user_info->is_legal_map = $request->is_legal_map;
        $user_info->is_education = $request->is_education;
        $user_info->save();

        return redirect('/admin/profile');

    }

    
    public function editPassword(Request $request){
        $user = Users::find($request->user_id);
        $user->password = Hash::make($request->password_new);
        $user->password_original = $request->password_new;
        $user->save();
        $url = '/admin/profile/'.$request->user_id.'?tab=password';
        return redirect($url);
    }

    public function activateUser(Request $request){
        $user = Users::find($request->user_id);
        $user->is_activated = 1;
        $user->activated_date = date("Y-m-d");
        $user->save();
        $url = '/admin/profile/'.$request->user_id;
        return redirect($url);
    }

    public function editMoney(Request $request){
        $user = Users::find($request->user_id);
        if($request->minus_money <= $user->user_money){
            $user->user_money = $user->user_money - $request->minus_money;
            $user->save();

            $operation = new UserOperation();
            $operation->author_id = 1;
            $operation->recipient_id = $user->user_id;
            $operation->money = $request->minus_money * -1;
            $operation->operation_id = 2;
            $operation->operation_type_id = 12;

            if($request->minus_money > 0){
                $operation->operation_comment = 'Администратор снял';
            }
            else{
                $operation->operation_comment = 'Администратор добавил';
            }

            $operation->save();
        }
        
        $url = '/admin/profile/'.$request->user_id.'?tab=money';
        return redirect($url);
    }

    public function editStatus(Request $request){
        $user = Users::find($request->user_id);

        $user->status_id = $request->status_id?$request->status_id:null;
        $user->save();

        $url = '/admin/profile/'.$request->user_id.'?tab=status';
        return redirect($url);
    }

    public function editProfit(Request $request){
        $user = Users::find($request->user_id);

        $comment = 'Администратор поменял командный объем; ЛКО: '.$user->left_child_profit .' на '.$request->left_child_profit;
        $comment .= ', ПКО: '.$user->right_child_profit .' на '.$request->right_child_profit;
        $comment .= ', КВО: '.$user->qualification_profit .' на '.$request->qualification_profit;

        $operation = new UserOperation();
        $operation->author_id = 1;
        $operation->recipient_id = $user->user_id;
        $operation->money = 0;
        $operation->operation_id = 1;
        $operation->operation_type_id = 19;
        $operation->operation_comment = $comment;
        $operation->save();

        $user->left_child_profit = $request->left_child_profit;
        $user->right_child_profit = $request->right_child_profit;
        $user->qualification_profit = $request->qualification_profit;
        $user->save();


        $url = '/admin/profile/'.$request->user_id.'?tab=profit';
        return redirect($url);
    }
}
