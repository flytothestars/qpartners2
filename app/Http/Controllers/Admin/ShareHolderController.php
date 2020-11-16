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
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class ShareHolderController extends Controller
{
    public function __construct()
    {
        $users = Users::orderBy('user_id','asc')->get();
        View::share('users_row', $users);

        $this->middleware('admin', ['only' => ['index','showAddUserShare','addUserShare']]);
    }

    public function index(Request $request)
    {
        $request->row = Users::leftJoin('city','city.city_id','=','users.city_id')
                            ->leftJoin('country','country.country_id','=','city.country_id')
                            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
                            ->orderBy('users.user_share','desc')
                            ->select('users.*','city.*','country.*',
                                DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'),
                                'recommend.name as recommend_name',
                                'recommend.user_id as recommend_id',
                                'recommend.login as recommend_login',
                                'recommend.last_name as recommend_last_name',
                                'recommend.middle_name as recommend_middle_name',
                                'recommend.user_id as recommend_user_id'
                            )
                            ->where('users.user_share','>',0);

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

        $row_share_sum = clone ($request->row);
        
        $request->row = $request->row->paginate(10);


        $row = UserOperation::leftJoin('users','users.user_id','=','user_operation.author_id')
            ->leftJoin('users as recipient_user','recipient_user.user_id','=','user_operation.recipient_id')
            ->leftJoin('operation','operation.operation_id','=','user_operation.operation_id')
            ->leftJoin('operation_type','operation_type.operation_type_id','=','user_operation.operation_type_id')
            ->leftJoin('fond','fond.fond_id','=','user_operation.fond_id')
            ->where('operation.operation_name_ru','like','%' .$request->operation .'%')
            ->where('user_operation.operation_type_id',5)
            ->where('operation_type.operation_type_name_ru','like','%' .$request->operation_type .'%')
            ->orderBy('user_operation_id','desc')
            ->select('users.*',
                'user_operation.money',
                'user_operation.operation_type_id',
                'user_operation.operation_comment',
                'operation.operation_name_ru',
                'fond.fond_name_ru',
                'operation_type.operation_type_name_ru',
                'recipient_user.name as recipient_name',
                'recipient_user.user_id as recipient_id',
                'recipient_user.last_name as recipient_last_name',
                DB::raw('DATE_FORMAT(user_operation.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->recipient_name) && $request->recipient_name != ''){
            $row->where(function($query) use ($request){
                $query->where('recipient_user.name','like','%' .$request->recipient_name .'%')
                    ->orWhere('recipient_user.last_name','like','%' .$request->recipient_name .'%');
            });
        }

        if(isset($request->date_from) && $request->date_from != ''){
            $timestamp = strtotime($request->date_from);
            $row->where(function($query) use ($timestamp){
                $query->where('user_operation.created_at','>=',date("Y-m-d H:i", $timestamp));
            });
        }

        if(isset($request->date_to) && $request->date_to != ''){
            $timestamp = strtotime($request->date_to);
            $row->where(function($query) use ($timestamp){
                $query->where('user_operation.created_at','<=',date("Y-m-d H:i", $timestamp));
            });
        }

        if(Auth::user()->role_id > 1) $row->where('user_operation.recipient_id',Auth::user()->user_id);

        $row_sum = clone ($row);

        $row = $row->paginate(10,['*'], 'other_page');
        $row->setPageName('other_page');
        $request->user_operation = $row;
        $request->user_share_sum = $row_share_sum->sum('users.user_share');
        $request->user_share_count = $row_share_sum->count();
        $request->user_operation_sum = $row_sum->sum('money');
        $request->shareholder_profit_today = UserOperation::where('operation_type_id',5)
                                        ->where('created_at','>',date("Y-m-d"))
                                        ->sum('money');

        if($request->shareholder_profit_today  != 0 && $request->user_share_sum != 0)
            $request->shareholder_average_mount = round($request->shareholder_profit_today / $request->user_share_sum,2);
        else $request->shareholder_average_mount = 0;
        
        return  view('admin.shareholder.shareholder',[
            'row' => $request,
            'title' => 'Дольщики',
            'request' => $request
        ]);
    }

    public function showAddUserShare()
    {
        $row = new UserOperation();

        return  view('admin.shareholder.shareholder-add', [
            'title' => 'Добавить долю',
            'row' => $row
        ]);
    }

    public function addUserShare(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_share' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.shareholder.shareholder-add', [
                'title' => 'Добавить долю',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $operation = new UserOperation();
        $operation->author_id = 1;
        $operation->recipient_id = $request->user_id;
        $operation->money = $request->user_share;
        $operation->operation_id = 1;
        $operation->operation_type_id = 2;
        $operation->operation_comment = $request->operation_comment;;
        $operation->save();

        $user = Users::where('user_id',$request->user_id)->first();
        $user->user_share = $user->user_share + $request->user_share;
        $user->save();

        return redirect('/admin/shareholder');
    }

    public function robot()
    {
        $fond = Fond::where('fond_id',2)->first();
        
        if($fond->fond_money > 0){
            $user_share_all = Users::where('user_share','>',0)->sum('user_share');
            $unit_share = $fond->fond_money / $user_share_all;

            $shareholder_list = Users::where('user_share','>',0)->get();
            foreach ($shareholder_list as $key => $item){
                $operation_check = UserOperation::where('recipient_id',$item->user_id)
                    ->where('operation_type_id',3)
                    ->where('created_at','>',date("Y-m-d"))
                    ->count();

                if($operation_check == 0){
                    $operation = new UserOperation();
                    $operation->author_id = 1;
                    $operation->recipient_id = $item->user_id;
                    $operation->money = $unit_share * $item->user_share;
                    $operation->operation_id = 1;
                    $operation->operation_type_id = 3;
                    $operation->operation_comment = round($unit_share,2) ." $ x ".$item->user_share ." доля";
                    $operation->save();

                    $user = Users::where('user_id',$item->user_id)->where('is_activated',1)->first();
                    if($user == null) continue;
                    $user->user_money = $user->user_money + ($unit_share * $user->user_share);
                    $user->save();
                }
            }
            $fond->fond_money = 0;
            $fond->save();
        }


        echo 'Успешно выполнено';
    }

}
