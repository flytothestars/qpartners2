<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Fond;
use App\Models\Operation;
use App\Models\Packet;
use App\Models\UserOperation;
use App\Models\UserRequest;
use App\Models\Users;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class UserRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile');
        $this->middleware('admin', ['only' => ['inactiveUserRequest','acceptInactiveUserRequest','deleteInactiveUserRequest']]);
    }

    public function showSendRequest(Request $request){
        $status = UserStatus::where('user_status_id',Auth::user()->status_id)->first();
        if($status == null) {
            $status = $request;
            $status->user_month_activation_money = 10;
        }

        return  view('admin.request.send-request',[
            'request' => $request,
            'status' => $status
        ]);
    }

    public function showSendAccount(Request $request){
        $status = UserStatus::where('user_status_id',Auth::user()->status_id)->first();
        if($status == null) {
            $status = $request;
            $status->user_month_activation_money = 10;
        }

        $users_row = Users::orderBy('last_name','asc')->get();
        View::share('users_row', $users_row);

        return  view('admin.request.send-money',[
            'request' => $request,
            'status' => $status
        ]);
    }

    public function inactiveUserRequest(Request $request)
    {
        $row = UserRequest::leftJoin('users','users.user_id','=','user_request.user_id')
            ->leftJoin('user_info','user_info.user_id','=','users.user_id')
            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
            ->where('user_request.is_accept',0)
            ->orderBy('user_request.user_request_id','desc')
            ->select('users.*',
                'user_request.*',
                'user_info.*',
                'recommend.name as recommend_name',
                'recommend.user_id as recommend_id',
                'recommend.login as recommend_login',
                'recommend.last_name as recommend_last_name',
                'recommend.user_id as recommend_user_id',
                DB::raw('DATE_FORMAT(user_request.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->user_name) && $request->user_name != '')
            $row->where(function($query) use ($request){
                $query->where('users.name','like','%' .$request->user_name .'%')
                    ->orWhere('users.last_name','like','%' .$request->user_name .'%')
                    ->orWhere('users.login','like','%' .$request->user_name .'%')
                    ->orWhere('users.email','like','%' .$request->user_name .'%')
                    ->orWhere('users.middle_name','like','%' .$request->user_name .'%');
            });

        if(isset($request->sponsor_name) && $request->sponsor_name != '')
            $row->where(function($query) use ($request){
                $query->where('recommend.name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.last_name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.login','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.email','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.middle_name','like','%' .$request->sponsor_name .'%');
            });

        $row = $row->paginate(10);

        return  view('admin.request.request',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function activeUserRequest(Request $request)
    {
        $row = UserRequest::leftJoin('users','users.user_id','=','user_request.user_id')
            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
            ->leftJoin('user_info','user_info.user_id','=','users.user_id')
            ->where('user_request.is_accept',1)
            ->orderBy('user_request.user_request_id','desc')
            ->select('users.*','user_request.*',
                'user_info.*',
                'recommend.name as recommend_name',
                'recommend.user_id as recommend_id',
                'recommend.login as recommend_login',
                'recommend.last_name as recommend_last_name',
                'recommend.user_id as recommend_user_id',
                DB::raw('DATE_FORMAT(user_request.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->user_name) && $request->user_name != '')
            $row->where(function($query) use ($request){
                $query->where('users.name','like','%' .$request->user_name .'%')
                    ->orWhere('users.last_name','like','%' .$request->user_name .'%')
                    ->orWhere('users.login','like','%' .$request->user_name .'%')
                    ->orWhere('users.email','like','%' .$request->user_name .'%')
                    ->orWhere('users.middle_name','like','%' .$request->user_name .'%');
            });

        if(isset($request->sponsor_name) && $request->sponsor_name != '')
            $row->where(function($query) use ($request){
                $query->where('recommend.name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.last_name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.login','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.email','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.middle_name','like','%' .$request->sponsor_name .'%');
            });

        if(isset($request->date_from) && $request->date_from != ''){
            $timestamp = strtotime($request->date_from);
            $row->where(function($query) use ($timestamp){
                $query->where('user_request.created_at','>=',date("Y-m-d H:i", $timestamp));
            });
        }

        if(isset($request->date_to) && $request->date_to != ''){
            $timestamp = strtotime($request->date_to);
            $row->where(function($query) use ($timestamp){
                $query->where('user_request.created_at','<=',date("Y-m-d H:i", $timestamp));
            });
        }

        $row_sum = clone ($row);

        $row = $row->paginate(10);

        return  view('admin.request.accept-request',[
            'row' => $row,
            'request' => $request,
            'row_sum' => $row_sum->sum('money')
        ]);
    }

    public function getDeletedUserRequest(Request $request)
    {
        $row = UserRequest::onlyTrashed()
            ->leftJoin('users','users.user_id','=','user_request.user_id')
            ->leftJoin('user_info','user_info.user_id','=','users.user_id')
            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
            ->orderBy('user_request.user_request_id','desc')
            ->select('users.*','user_request.*',
                'user_info.*',
                'recommend.name as recommend_name',
                'recommend.user_id as recommend_id',
                'recommend.login as recommend_login',
                'recommend.last_name as recommend_last_name',
                'recommend.user_id as recommend_user_id',
                DB::raw('DATE_FORMAT(user_request.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->user_name) && $request->user_name != '')
            $row->where(function($query) use ($request){
                $query->where('users.name','like','%' .$request->user_name .'%')
                    ->orWhere('users.last_name','like','%' .$request->user_name .'%')
                    ->orWhere('users.login','like','%' .$request->user_name .'%')
                    ->orWhere('users.email','like','%' .$request->user_name .'%')
                    ->orWhere('users.middle_name','like','%' .$request->user_name .'%');
            });

        if(isset($request->sponsor_name) && $request->sponsor_name != '')
            $row->where(function($query) use ($request){
                $query->where('recommend.name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.last_name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.login','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.email','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.middle_name','like','%' .$request->sponsor_name .'%');
            });

        if(isset($request->date_from) && $request->date_from != ''){
            $timestamp = strtotime($request->date_from);
            $row->where(function($query) use ($timestamp){
                $query->where('user_request.created_at','>=',date("Y-m-d H:i", $timestamp));
            });
        }

        if(isset($request->date_to) && $request->date_to != ''){
            $timestamp = strtotime($request->date_to);
            $row->where(function($query) use ($timestamp){
                $query->where('user_request.created_at','<=',date("Y-m-d H:i", $timestamp));
            });
        }

        $row_sum = clone ($row);

        $row = $row->paginate(10);

        return  view('admin.request.deleted-request',[
            'row' => $row,
            'request' => $request,
            'row_sum' => $row_sum->sum('money')
        ]);
    }

    public function sendResponseAddRequest(Request $request)
    {
        if(Auth::user()->is_valid_document == 0){
            $result['message'] = 'Вы не прошли верификацию';
            $result['status'] = false;
            return response()->json($result);
        }

        if($request->money <= 0){
            $result['message'] = 'Укажите корректную сумму';
            $result['status'] = false;
            return response()->json($result);
        }

        if(UserRequest::where('is_accept',0)->where('user_id',Auth::user()->user_id)->count() > 0){
            $result['message'] = 'Вы уже отправили запрос';
            $result['status'] = false;
            return response()->json($result);
        }

        /*if(Auth::user()->user_money - $status->user_month_activation_money < 0){
            $result['message'] = 'Недостаточно средств';
            $result['status'] = false;
            return response()->json($result);
        }

        if(Auth::user()->user_money - $request->money < $status->user_month_activation_money){
            $count = Auth::user()->user_money - $status->user_month_activation_money;
            $result['message'] = 'Вы можете снять максимум '.$count.'$';
            $result['status'] = false;
            return response()->json($result);
        }*/

        if(Auth::user()->user_money - $request->money < 0){
            $result['message'] = 'Вы можете снять максимум '.Auth::user()->user_money.'$';
            $result['status'] = false;
            return response()->json($result);
        }

        if($request->money < 40){
            $result['message'] = 'Вы можете снять минимум '.$request->money.'$';
            $result['status'] = false;
            return response()->json($result);
        }

        $user_request = new UserRequest();
        $user_request->user_id = Auth::user()->user_id;
        $user_request->money = $request->money;
        $user_request->comment = $request->comment;
        $user_request->is_accept = 0;
        $user_request->save();

        $result['message'] = 'Вы успешно отправили запрос';
        $result['status'] = true;
        return response()->json($result);
    }

    public function sendMoneyToAccount(Request $request)
    {
       /* if(Auth::user()->is_valid_document == 0){
            $result['message'] = 'Вы не прошли верификацию';
            $result['status'] = false;
            return response()->json($result);
        }*/

        if($request->recipient_id == 0 || $request->recipient_id == ''){
            $result['message'] = 'Вы не выбрали получателя';
            $result['status'] = false;
            return response()->json($result);
        }

        if($request->money <= 0){
            $result['message'] = 'Укажите корректную сумму';
            $result['status'] = false;
            return response()->json($result);
        }

        /*if(Auth::user()->user_money - $status->user_month_activation_money < 0){
            $result['message'] = 'Недостаточно средств';
            $result['status'] = false;
            return response()->json($result);
        }

        if(Auth::user()->user_money - $request->money < $status->user_month_activation_money){
            $count = Auth::user()->user_money - $status->user_month_activation_money;
            $result['message'] = 'Вы можете снять максимум '.$count.'$';
            $result['status'] = false;
            return response()->json($result);
        }*/

        if(Auth::user()->user_money - $request->money < 0){
            $result['message'] = 'Вы можете отправить максимум '.Auth::user()->user_money.'$';
            $result['status'] = false;
            return response()->json($result);
        }

        $operation = new UserOperation();
        $operation->author_id = $request->recipient_id;
        $operation->recipient_id = Auth::user()->user_id;
        $operation->money = $request->money * -1;
        $operation->operation_id = 2;
        $operation->operation_type_id = 28;
        $operation->operation_comment = $request->comment;
        $operation->save();

        $user = Users::find(Auth::user()->user_id);
        $user->user_money = $user->user_money - $request->money;
        $user->save();

        $money = $request->money;

        $operation = new UserOperation();
        $operation->author_id = Auth::user()->user_id;
        $operation->recipient_id = $request->recipient_id;
        $operation->money = $money;
        $operation->operation_id = 1;
        $operation->operation_type_id = 29;
        $operation->operation_comment = $request->comment;
        $operation->save();

        $user = Users::find($request->recipient_id);
        $user->user_money = $user->user_money + $money;
        $user->save();

       /* $operation = new UserOperation();
        $operation->author_id = Auth::user()->user_id;
        $operation->recipient_id = 1;
        $operation->money = $request->money * 10 / 100;
        $operation->operation_id = 1;
        $operation->operation_type_id = 28;
        $operation->operation_comment = 'Налог 10%';
        $operation->save();

        $user = Users::find(1);
        $user->user_money = $user->user_money + $request->money * 10 / 100;
        $user->save();*/

        $result['message'] = 'Вы успешно отправили деньги';
        $result['status'] = true;
        return response()->json($result);
    }

    public function acceptInactiveUserRequest(Request $request)
    {
        $user_request = UserRequest::find($request->user_request_id);

        
        if($user_request == null || $user_request->is_accept == 1) {
            $result['status'] = false;
            return response()->json($result);
        }

        $user_request->is_accept = 1;
        $user_request->save();

        $operation = new UserOperation();
        $operation->author_id = 1;
        $operation->recipient_id = $user_request->user_id;
        $operation->money = $user_request->money * -1;
        $operation->operation_id = 2;
        $operation->operation_type_id = 12;
        $operation->operation_comment = '';
        $operation->save();

        $user = Users::find($user_request->user_id);
        $user->user_money = $user->user_money - $user_request->money;
        $user->save();

        $result['message'] = 'Вы успешно приняли запрос';
        $result['status'] = true;
        return response()->json($result);
    }

    public function deleteInactiveUserRequest(Request $request)
    {
        $user_request = UserRequest::find($request->user_request_id);
        $user_request->delete();
    }

}
